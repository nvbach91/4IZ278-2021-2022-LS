<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
        <td align="center">
            <table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0"
                   style="margin-left:20px; margin-right:20px; border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9;">
                <tbody>
                <tr>
                    <td height="35"></td>
                </tr>

                <tr>
                    <td align="center"
                        style="font-family: 'Poppins', sans-serif; font-size:22px; font-weight: bold; color:#111;">
                        {{$subject}}
                    </td>
                </tr>

                <tr>
                    <td height="10"></td>
                </tr>
                <tr>
                    <td align="left"
                        style="font-family: 'Poppins', sans-serif; padding: 15px; font-size:14px; color:#757575; line-height:24px; font-weight: 300;">
                        <br>
                        <table style="
border-collapse: collapse;
display: block;
margin: 20px auto;
text-align: left !important;
font-size: 12px!important;
width: 100%;

background-color: #F2F2F2!important;">
                            <tr>
                                <th style="color: white;
padding: 8px;
background-color: #F7931A;">Jméno
                                </th>
                                <td style="padding-left: 30px !important;
padding: 8px;">{{$data->user->first_name}}</td>
                                <th style="color: white;
padding: 8px;
background-color: #F7931A;">Město
                                </th>
                                <td style="padding-left: 30px !important;
padding: 8px;">{{$data->address->town}}</td>
                            </tr>
                            <tr>
                                <th style="color: white;
padding: 8px;
background-color: #F7931A;">Příjmení
                                </th>
                                <td style="padding-left: 30px !important;
padding: 8px;">{{$data->user->first_name}}</td>
                                <th style="color: white;
padding: 8px;
background-color: #F7931A;">Ulice
                                </th>
                                <td style="padding-left: 30px !important;
padding: 8px;">{{$data->address->street}}</td>
                            </tr>
                            <tr>
                                <th style="color: white;
padding: 8px;
background-color: #F7931A;">Telefon
                                </th>
                                <td style="padding-left: 30px !important;
padding: 8px;">{{$data->user->phone}}</td>
                                <th style="color: white;
padding: 8px;
background-color: #F7931A;">Číslo popisné
                                </th>
                                <td style="padding-left: 30px !important;
padding: 8px;">{{$data->address->street_number}}</td>
                            </tr>
                            <tr>
                                <th style="color: white;
padding: 8px;
background-color: #F7931A;">Email
                                </th>
                                <td style="padding-left: 30px !important;
padding: 8px;">{{$data->user->email}}</td>
                                <th style="color: white;
padding: 8px;
background-color: #F7931A;">PSČ
                                </th>
                                <td style="padding-left: 30px !important;
padding: 8px;">{{$data->address->zip}}</td>
                            </tr>
                            <tr>
                                <th style="color: white;
padding: 8px;
background-color: #F7931A;">Kraj
                                </th>
                                <td style="padding-left: 30px !important;
padding: 8px;">{{$data->address->region}}</td>
                                <th style="color: white;
padding: 8px;
background-color: #F7931A;">Datum vytvoření
                                </th>
                                <td style="padding-left: 30px !important;
padding: 8px;">{{ \Carbon\Carbon::parse($data->created_at)->format('d.m. Y') }}</td>
                            </tr>
                        </table>
                        <table style="
        border-collapse: collapse;
        width: 100% !important;">
                            <tr>
                                <th style="        text-align: left;
        padding: 8px;
        font-size: 14px;
        background-color: #F7931A;
        color: white;">Produkt
                                </th>
                                <th style="        text-align: left;
        padding: 8px;
        font-size: 14px;
        background-color: #F7931A;
        color: white;">Množství
                                </th>
                                <th style="        text-align: left;
        padding: 8px;
        font-size: 14px;
        background-color: #F7931A;
        color: white;">Cena
                                </th>
                            </tr>
                            @foreach ($products as $product)
                                <tr class="last">
                                    <td style="        text-align: left;
        padding: 8px;
        font-size: 14px;">
                                        {{ $product["product_name_fulled"] }}
                                    </td>
                                    <td style="        text-align: left;
        padding: 8px;
        font-size: 14px;">{{ number_format($product["quantity"] , 2, ",", " ") }} ks
                                    </td>
                                    <td style="        text-align: left;
        padding: 8px;
        font-size: 14px;">
                                        {{ number_format($product["price"], 2, ",", " ")  }} Kč
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <table style="
        border-collapse: collapse;
        display: block;
        margin: 20px auto;
        text-align: left !important;
        font-size: 12px !important;
        width: 350px;

        background-color: #F2F2F2 !important;">
                            <tr>
                                <th style="color: white;
padding: 8px;
background-color: #F7931A;">Bankovní účet
                                </th>
                                <td style="padding-left: 30px !important;
padding: 8px;">123-3215680297/0100
                                </td>
                            </tr>
                            <tr>
                                <th style="color: white;
padding: 8px;
background-color: #F7931A;">IBAN
                                </th>
                                <td style="padding-left: 30px !important;
padding: 8px;">CZ18 0100 0001 2332 1568 0297
                                </td>
                            </tr>
                            <tr>
                                <th style="color: white;
padding: 8px;
background-color: #F7931A;">SWIFT
                                </th>
                                <td style="padding-left: 30px !important;
padding: 8px;">KOMBCZPP
                                </td>
                            </tr>
                            <tr>
                                <th style="color: white;
padding: 8px;
background-color: #F7931A;">Variabilní symbol
                                </th>
                                <td style="padding-left: 30px !important;
padding: 8px;">{{$data->variable_symbol}}</td>
                            </tr>
                            <tr>
                                <th style="color: white;
padding: 8px;
background-color: #F7931A;">K úhradě
                                </th>
                                <td style="padding-left: 30px !important;
padding: 8px;"><b>{{number_format($data->total , 2, ",", " ") }} Kč</b></td>
                            </tr>
                        </table>
                    </td>
                </tr>

                </tbody>
            </table>
        </td>
    </tr>


    <tr>
        <td align="center">
            <table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0"
                   style="margin-left:20px; margin-right:20px;">


                <tbody>

                <!-- START READY FOR NEW PROJECT -->

                <tr>
                    <td align="center">
                        <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0"
                               style=" border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9;">
                            <tbody>
                            <tr>
                                <td height="50"></td>
                            </tr>
                            <tr>


                                <td align="center" bgcolor="#111111">
                                    <table class="col-600" width="600" border="0" align="center" cellpadding="0"
                                           cellspacing="0">
                                        <tbody>

                                        <tr>
                                            <td height="20"></td>
                                        </tr>


                                        <tr>
                                            <td align="center"
                                                style="font-family: 'Poppins', sans-serif; font-size:14px; color:#fff; line-height: 1px; font-weight: 300;">
                                                Copyright {{date('Y')}} © <a href="https://jindrichsvoboda.cz/"
                                                                             style="color: white; text-decoration: none;">haos.store</a>
                                                | Vytvořil <a
                                                    class="odkaz-yeet" target="_blank"
                                                    href="https://yeetzone.com/"
                                                    style="color: white; text-decoration: unset;">Yeetzone</a>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td height="20"></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>


                </tbody>
            </table>
        </td>
    </tr>

    <!-- END FOOTER -->


    </tbody>
</table>
