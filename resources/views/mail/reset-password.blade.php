<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinição de Senha</title>
</head>
<body style="margin:0;padding:0;background-color:#f1f5f9;font-family:Arial,Helvetica,sans-serif;color:#0f172a;">
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color:#f1f5f9;padding:24px 12px;">
    <tr>
        <td align="center">
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:620px;background-color:#ffffff;border:1px solid #e2e8f0;border-radius:12px;overflow:hidden;">
                <tr>
                    <td style="padding:24px;border-bottom:1px solid #e2e8f0;">
                        <h1 style="margin:0;font-size:22px;line-height:1.3;color:#0f172a;">Redefinição de senha</h1>
                        <p style="margin:8px 0 0 0;font-size:14px;line-height:1.5;color:#475569;">Solicitação de redefinição para acesso ao sistema.</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:24px;">
                        <p style="margin:0 0 12px 0;font-size:15px;line-height:1.6;color:#334155;">Olá{{ !empty($username) ? ' ' . $username : '' }},</p>
                        <p style="margin:0 0 16px 0;font-size:15px;line-height:1.6;color:#334155;">Recebemos uma solicitação para redefinir sua senha. Clique no botão abaixo para continuar:</p>

                        <table role="presentation" cellspacing="0" cellpadding="0" style="margin:0 0 16px 0;">
                            <tr>
                                <td align="center" style="border-radius:8px;background-color:#0f172a;">
                                    <a href="{{ $linkWithToken }}" style="display:inline-block;padding:12px 18px;font-size:14px;font-weight:600;line-height:1;color:#ffffff;text-decoration:none;">Redefinir minha senha</a>
                                </td>
                            </tr>
                        </table>

{{--                        <p style="margin:0 0 12px 0;font-size:14px;line-height:1.6;color:#475569;">Este link expira em {{ $expireMinutes ?? 60 }} minutos.</p>--}}
                        <p style="margin:0 0 16px 0;font-size:14px;line-height:1.6;color:#475569;">Se você não solicitou a redefinição, ignore este email.</p>

                        <p style="margin:0 0 6px 0;font-size:12px;line-height:1.5;color:#64748b;">Se o botão não funcionar, copie e cole o link abaixo no navegador:</p>
                        <p style="margin:0 0 18px 0;font-size:12px;line-height:1.5;word-break:break-all;color:#334155;">{{ $linkWithToken }}</p>

{{--                        <p style="margin:0;font-size:13px;line-height:1.6;color:#334155;">Atenciosamente,<br>{{ $appName ?? config('app.name') }}</p>--}}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
