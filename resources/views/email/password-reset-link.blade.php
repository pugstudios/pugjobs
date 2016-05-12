<!-- Stored in resources/views/child.blade.php -->

@extends('email.master')

@section('title', 'Password Reset Link - PugJobs.com')

@section('content')

<table class="layout layout--no-gutter" style="border-collapse: collapse;table-layout: fixed;Margin-left: auto;Margin-right: auto;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #fafafa;" align="center">
    <tbody>
        <tr>
            <td class="column" style="padding: 0;text-align: left;vertical-align: top;color: #595959;font-size: 14px;line-height: 21px;font-family: Lato,Tahoma,sans-serif;width: 600px;">

                <div style="Margin-left: 20px;Margin-right: 20px;Margin-top: 24px;">
                    <h1 class="size-32" style="Margin-top: 0;Margin-bottom: 0;font-style: normal;font-weight: normal;color: #b8bdc9;font-size: 32px;line-height: 40px;text-align: center;">
                        Password Reset Request
                    </h1>
                </div>

                <div style="Margin-left: 20px;Margin-right: 20px;">
                    <p class="size-17" style="Margin-top: 0;Margin-bottom: 20px;font-size: 17px;line-height: 26px;">
                        You are receiving this email because you have requested that your PugJobs.com account password be reset.
                    </p>
                </div>

                <div style="Margin-left: 20px;Margin-right: 20px;">
                    <div class="divider" style="display: block;font-size: 2px;line-height: 2px;width: 40px;background-color: #c7c7c7;Margin-left: 260px;Margin-right: 260px;Margin-bottom: 20px;">&nbsp;</div>
                </div>

                <div style="Margin-left: 20px;Margin-right: 20px;">
                    <div class="btn btn--flat" style="Margin-bottom: 20px;text-align: center;">
                        <![if !mso]>
                        <a href="{{ url('user/password/reset') }}/{{ $token }}" style="border-radius: 4px;display: inline-block;font-weight: bold;text-align: center;text-decoration: none !important;transition: opacity 0.1s ease-in;color: #fff;background-color: #6b7489;font-family: Lato, Tahoma, sans-serif;font-size: 14px;line-height: 24px;padding: 12px 35px;">
                            Click Here To Reset Your Password
                        </a>
                        <![endif]>
                      <!--[if mso]>
                      <p style="line-height:0;margin:0;">&nbsp;</p>
                      <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" href="{{ url('user/password/reset') }}" style="width:290px" arcsize="9%" fillcolor="#6B7489" stroke="f">
                        <v:textbox style="mso-fit-shape-to-text:t" inset="0px,11px,0px,11px">
                            <center style="font-size:14px;line-height:24px;color:#FFFFFF;font-family:Tahoma,sans-serif;font-weight:bold;mso-line-height-rule:exactly;mso-text-raise:4px">
                              Click Here To Reset Your Password
                            </center>
                        </v:textbox>
                      </v:roundrect>
                      <![endif]-->
                    </div>
                </div>

                <div style="Margin-left: 20px;Margin-right: 20px;">
                    <div class="divider" style="display: block;font-size: 2px;line-height: 2px;width: 40px;background-color: #c7c7c7;Margin-left: 260px;Margin-right: 260px;Margin-bottom: 20px;">&nbsp;</div>
                </div>

                <div style="Margin-left: 20px;Margin-right: 20px;Margin-bottom: 24px;">
                    <p class="size-17" style="Margin-top: 0;Margin-bottom: 0;font-size: 17px;line-height: 26px;">
                        If you have not requested a new password, please ignore this message. Your existing password will remain unchanged.
                    </p>
                </div>

            </td>
        </tr>
    </tbody></table>

@endsection