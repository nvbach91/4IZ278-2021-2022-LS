<style>
    * {
        box-sizing: border-box;

    }

    body {
        font-family: DejaVu Sans;
        color: #292929;
    }

    table {
        width: 100%;
        border-collapse: collapse;

    }

    th, td {
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 5px;
        padding-bottom: 5px;
        text-align: left !important;
    }

    tr:first-child {
        background-color: #292929;
    }

    th {
        font-size: 16px;
    }

    td {
        font-size: 14px;
    }

    th {
        color: white;
        font-size: 14px
    }

    .dates {
        margin-top: -40px;
        height: 50px;
        width: 100%;
        position: relative;
    }

    .dates div {
        text-align: left;
        width: 33.3%;
        float: left;
        font-size: 12px;
    }
</style>
<div style="padding: 0px; ">
    <div style="width: 100%;  position: relative; height: 150px;">

        <a href="https://haos.store">
            <img src="http://hejnadaniel.cz/haos.png" style="position: absolute;  left:0; top:0; height: 60px;">
        </a>

        <div style="position: absolute; top: 0; right: 0; width: 250px; height: 40px;">

            @if($data->status === "pending")
                <h4 style="text-align: right; margin-top: 5px;">Proforma faktura</h4>
            @else
                <h4 style="text-align: right; margin-top: 5px;">Faktura - daňový doklad</h4>
            @endif
            <h5 style="text-align: right; margin-top: -25px;">Evidenční číslo - {{$data->variable_symbol}}</h5>
        </div>
    </div>

    <section style="width: 100%;  position: relative; height: 175px; ">
        <div style="width: 40%; float: left;">
            <p style="margin-top: -20px; font-size: 20px;">Dodavatel</p>
            <p style="margin-top: -15px; font-size: 14px;">Daniel Hejna</p>
            <p style="margin-top: -15px; font-size: 14px;">Šeříková 5. Cheb</p>
            <p style="margin-top: -15px; font-size: 14px;">IČ: 08559902</p>
        </div>
        <div style="width: 55%; float: right;">
            <p style="margin-top: -20px; font-size: 20px;">Odběratel</p>
            <p style="margin-top: -15px; font-size: 14px;"> {{$data->user->first_name." ".$data->user->last_name }}</p>
            <p style="margin-top: -15px; font-size: 14px;">{{$data->address->street.' '.$data->address->street_number.' '.$data->address->town.', '.$data->address->zip }}</p>
        </div>
    </section>

    <div class="dates">
        <div>
            <p>Datum vystavení: {{ \Carbon\Carbon::parse($data->created_at)->format('d.m. Y') }}</p>
        </div>
        <div>
            <p>Datum dodání: {{ \Carbon\Carbon::parse($data->created_at)->format('d.m. Y') }}</p>
        </div>
        <div>
            <p>Datum splatnosti: {{ \Carbon\Carbon::parse($data->created_at)->addDays(7)->format('d.m. Y') }}</p>
        </div>
    </div>

    <table style="width: 100%; margin-top: -10px; ">
        <colgroup>
            <col style="width: 90%;">
            <col style="width: 5%;">
            <col style="width: 5%; ">
        </colgroup>
        <tr>
            <th style="text-align: left; width: 285px!important;">Bankovní účet</th>
            <th>Variabilní symbol</th>
            <th>K úhradě</th>
        </tr>
        <tr>
            <td colspan="3" style="width: 100%; padding:1px;"></td>
        </tr>
        <tr style='background-color: #292929; color: white;'>
            <td style="width: 285px!important;"><b>123-3215680297/0100</b></td>
            <td><b>{{$data->variable_symbol}}</b></td>
            <td><b>{{ number_format($data->total, 0, ",", " ") }} Kč</b></td>
        </tr>
        <tr style='background-color: #292929; color: white;'>
            <td colspan="2">IBAN: <b>CZ18 0100 0001 2332 1568 0297</b></td>
            <td></td>
        </tr>
        <tr style='background-color: #292929; color: white;'>
            <td>SWIFT: <b>KOMBCZPP</b></td>
            <td colspan="2" style="text-align: right!important;">Způsob platby: Bankovní převod</td>
        </tr>
    </table>

    <table style="width: 100%; margin-top: 10px;">
        <colgroup>
            <col style="width: 90%;">
            <col style="width: 5%;">
            <col style="width: 5%; ">
        </colgroup>
        <tr>
            <th style="text-align: left; width: 285px!important;">Produkt</th>
            <th>Množství</th>
            <th>Cena</th>
        </tr>

        @foreach ($products as $product)
            <tr class="last">
                <td style=" text-align: left; width: 285px!important;">
                    {{ $product["product_name_fulled"] }}
                </td>
                <td style="text-align: center;">{{ number_format($product["quantity"] , 2, ",", " ") }} ks
                </td>
                <td style="text-align: left;">
                    {{ number_format($product["price"], 2, ",", " ")  }} Kč
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3" style="width: 100%; height: 10px;"></td>
        </tr>
        <tr>
            <td colspan="3" style="background-color: #292929; height: 1px; padding: 0;"></td>
        </tr>
        <tr>
            <td></td>
            <td style="text-align: left;"><b>Celkem</b></td>
            <td style="text-align: left;">{{ number_format( $data->total, 0, ",", " ") }} Kč</td>
        </tr>
        <tr>
            <td></td>
            <td style="text-align: left;"><b>Uhrazeno zálohami</b></td>
            <td style="text-align: left;">{{ number_format($data->depositPayment, 0, ",", " ") }} Kč
            </td>
        </tr>

        <tr>
            <td></td>
            <td style="text-align: left;"><b>Zůstává uhradit</b></td>
            <td style="text-align: left;">{{ number_format( $data->total, 0, ",", " ") }} Kč</td>
        </tr>
        <tr>
            <td></td>
            <td style="text-align: left;"><b>K úhradě</b></td>
            <td style="text-align: left;"><b>{{ number_format( $data->total), 0, ",", " " }} Kč</b>
            </td>
        </tr>
    </table>
</div>

<div style="position: absolute; bottom: 15px; width: 100%; height: 1px; background-color: #292929;">
    <a style="text-align: center; color: #BCBCBC; text-decoration: none; font-size: 14px; display: block; maring: auto; position: relative; margin-top: 15px!important;"
       target="_blank"
       href="https://haos.store/">haos.store</a>
    <a style="text-align: left; color: #BCBCBC; text-decoration: none; font-size: 14px; display: block;  position: relative; margin-top: -20px!important;"
       target="_blank"
       href="mailto:info@haos.store">info@haos.store</a>
    <a style="text-align: right; color: #BCBCBC; text-decoration: none; font-size: 14px; display: block;  position: relative; margin-top: -20px!important;"
       target="_blank"
       href="https://haos.store/">Fakturační systém HaoS</a>
</div>


