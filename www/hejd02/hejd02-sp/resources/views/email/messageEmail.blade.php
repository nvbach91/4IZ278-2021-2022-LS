<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

    <!-- START HEADER/BANNER -->

    <tbody>


    <!-- END HEADER/BANNER -->


    <!-- START 3 BOX SHOWCASE -->

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
                        style="font-family: 'Poppins', sans-serif; font-size:22px; font-weight: bold; color:#111111;">
                        Zpráva z webu
                    </td>
                </tr>

                <tr>
                    <td height="10"></td>
                </tr>
                <tr>
                    <td align="left"
                        style="font-family: 'Poppins', sans-serif; padding: 15px; font-size:14px; color:#757575; line-height:24px; font-weight: 300;">
                        {{ $data->name }} <br>

                        <a href="mailto:{{ $data->email }}">{{ $data->email }}</a> <br>

                        {{ $data->subject }}

                        <br>
                        <p>Zpráva: {{ $data->message }}</p>
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
