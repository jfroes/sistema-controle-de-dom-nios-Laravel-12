<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso ao Sistema</title>
</head>
<body style="margin:0;padding:0;background-color:#f1f5f9;font-family:Arial,Helvetica,sans-serif;color:#0f172a;">
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color:#f1f5f9;padding:24px 12px;">
    <tr>
        <td align="center">
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:620px;background-color:#ffffff;border:1px solid #e2e8f0;border-radius:12px;overflow:hidden;">
                <tr>
                    <td style="padding:24px;border-bottom:1px solid #e2e8f0;">
                        <h1 style="margin:0;font-size:22px;line-height:1.3;color:#0f172a;">Seu acesso foi criado</h1>
                        <p style="margin:8px 0 0 0;font-size:14px;line-height:1.5;color:#475569;">Confira abaixo seus dados de acesso inicial ao sistema.</p>
                    </td>
                </tr>

                <tr>
                    <td style="padding:24px;">
                        <p style="margin:0 0 12px 0;font-size:15px;line-height:1.6;color:#334155;">Olá{{ !empty($username) ? ' ' . $username : '' }},</p>
                        <p style="margin:0 0 16px 0;font-size:15px;line-height:1.6;color:#334155;">Sua conta foi cadastrada com sucesso. Use os dados abaixo para fazer seu primeiro acesso:</p>

                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:0 0 16px 0;border:1px solid #e2e8f0;border-radius:10px;overflow:hidden;">
                            <tr>
                                <td style="padding:12px 14px;background-color:#f8fafc;border-bottom:1px solid #e2e8f0;font-size:13px;color:#64748b;">Login</td>
                            </tr>
                            <tr>
                                <td style="padding:12px 14px;font-size:14px;color:#0f172a;font-weight:600;word-break:break-word;">{{ $loginEmail }}</td>
                            </tr>
                            <tr>
                                <td style="padding:12px 14px;background-color:#f8fafc;border-top:1px solid #e2e8f0;border-bottom:1px solid #e2e8f0;font-size:13px;color:#64748b;">Senha temporária</td>
                            </tr>
                            <tr>
                                <td style="padding:12px 14px;font-size:14px;color:#0f172a;font-weight:600;word-break:break-word;">{{ $temporaryPassword }}</td>
                            </tr>
                        </table>

                        <table role="presentation" cellspacing="0" cellpadding="0" style="margin:0 0 16px 0;">
                            <tr>
                                <td align="center" style="border-radius:8px;background-color:#0f172a;">
                                    <a href="{{ route('login') }}" style="display:inline-block;padding:12px 18px;font-size:14px;font-weight:600;line-height:1;color:#ffffff;text-decoration:none;">Acessar aplicação</a>
                                </td>
                            </tr>
                        </table>

                        <p style="margin:0 0 10px 0;font-size:14px;line-height:1.6;color:#475569;">Por segurança, será solicitada a alteração de senha no primeiro login.</p>
                        <p style="margin:0 0 6px 0;font-size:12px;line-height:1.5;color:#64748b;">Se o botão não funcionar, copie e cole o link abaixo no navegador:</p>
                        <p style="margin:0 0 16px 0;font-size:12px;line-height:1.5;word-break:break-all;color:#334155;">{{ route('login') }}</p>

{{--                        @if (!empty($supportEmail))--}}
{{--                            <p style="margin:0 0 14px 0;font-size:13px;line-height:1.6;color:#475569;">Em caso de dúvidas, entre em contato com <a href="mailto:{{ $supportEmail }}" style="color:#0f172a;text-decoration:underline;">{{ $supportEmail }}</a>.</p>--}}
{{--                        @endif--}}

                        <p style="margin:0;font-size:13px;line-height:1.6;color:#334155;">Atenciosamente,<br>{{ $appName ?? config('app.name') }}</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
