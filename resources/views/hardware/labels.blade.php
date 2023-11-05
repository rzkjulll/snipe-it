<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Labels</title>

</head>
<body>

<?php
$settings->labels_width = $settings->labels_width - $settings->labels_display_sgutter;
$settings->labels_height = $settings->labels_height - $settings->labels_display_bgutter;
// Leave space on bottom for 1D barcode if necessary
$qr_size = ($settings->alt_barcode_enabled=='1') && ($settings->alt_barcode!='') ? $settings->labels_height - .3 : $settings->labels_height - 0.1;
?>

<style>
    body {
        font-family: arial, helvetica, sans-serif;
        width: {{ $settings->labels_pagewidth }}in;
        height: {{ $settings->labels_pageheight }}in;
        margin: {{ $settings->labels_pmargin_top }}in {{ $settings->labels_pmargin_right }}in {{ $settings->labels_pmargin_bottom }}in {{ $settings->labels_pmargin_left }}in;
        font-size: {{ $settings->labels_fontsize }}pt;
    }
    .label {
        width: {{ $settings->labels_width }}in;
        height: {{ $settings->labels_height }}in;
        padding: 0in;
        margin-right: {{ $settings->labels_display_sgutter }}in; /* the gutter */
        margin-bottom: {{ $settings->labels_display_bgutter }}in;
        display: inline-block;
        overflow: hidden;
        border:solid 1px #000;
    }
    .page-break  {
        page-break-after:always;
    }
    div.qr_img {
        width: {{ $qr_size }}in;
        height: {{ $qr_size }}in;

        float: left;
        display: inline-flex;
        padding-right: .15in;
    }
    img.qr_img {
        margin-top: -6.9%;
        margin-left: -6.9%;
    }
    img.barcode {
        display:block;

        padding-top: .11in;
        width: 100%;
    }
    div.label-logo {text-align: center}
    img.label-logo {
        height: 0.5in;
        margin-top:-5px;
    }
    .qr_text {
        width: {{ $settings->labels_width }}in;
        height: {{ $settings->labels_height }}in;
        padding-top: {{$settings->labels_display_bgutter}}in;
        font-family: arial, helvetica, sans-serif;
        font-size: {{$settings->labels_fontsize}}pt;
        padding-right: .0001in;
        overflow: hidden !important;
        display: inline;
        word-wrap: break-word;
        word-break: break-all;
        text-align:center;
    }
    div.barcode_container {

        width: 100%;
        display: inline;
        overflow: hidden;
    }
    .next-padding {
        margin: {{ $settings->labels_pmargin_top }}in {{ $settings->labels_pmargin_right }}in {{ $settings->labels_pmargin_bottom }}in {{ $settings->labels_pmargin_left }}in;
    }
    .c_text{border-bottom: double 3px #000000; text-align:center; font-weight:bold;}
    .email{margin-top:-17px}
    .phone{margin:3px 0 3px 0;}
    @media print {
        .noprint {
            display: none !important;
        }
        .next-padding {
            margin: {{ $settings->labels_pmargin_top }}in {{ $settings->labels_pmargin_right }}in {{ $settings->labels_pmargin_bottom }}in {{ $settings->labels_pmargin_left }}in;
            font-size: 0;
        }
    }
    @media screen {
        .label {
            outline: .02in black solid; /* outline doesn't occupy space like border does */
        }
        .noprint {
            font-size: 13px;
            padding-bottom: 15px;
        }
    }
    @if ($snipeSettings->custom_css)
        {!! $snipeSettings->show_custom_css() !!}
    @endif
</style>

@foreach ($assets as $asset)
    @php
        $email = "cs@shipper.id";
        $phone = "WA (+62) 803-3216-0215";
        if($asset->company->id == 3 || $asset->company->name == "PT Pinduit Teknologi Indonesia"){
            $email = "cs@pintek.id";
            $phone = "WA (+62) 812-9798-7281";
        }

        $count++;
    @endphp 
    <div class="label">
        <div class="c_text text-center">
            Property of {{ $asset->company->name }}
        </div>

        <div class="qr_img">
            <img src="{{ config('app.url') }}/hardware/{{ $asset->id }}/qr_code" class="qr_img">
        </div>

        <div class="qr_text">
            <div class="label-logo">
                <img class="label-logo" src="{{ Storage::disk('public')->url('companies/').e($asset->company->image) }}">
            </div>
            <div class="email">
                <strong>{{$email}}</strong>
            </div>
            <div class="phone">
                {{$phone}}
            </div>
            <div class="tags">
                {{ $asset->asset_tag }}
            </div>
        </div>

        @if ((($settings->alt_barcode_enabled=='1') && $settings->alt_barcode!=''))
            <div class="barcode_container">
                <img src="{{ config('app.url') }}/hardware/{{ $asset->id }}/barcode" class="barcode">
            </div>
        @endif



    </div>

    @if ($count % $settings->labels_per_page == 0)
        <div class="page-break"></div>
        <div class="next-padding">&nbsp;</div>
    @endif

@endforeach


</body>
</html>
