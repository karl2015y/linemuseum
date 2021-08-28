<!DOCTYPE html>
<html>
<head>
    <title>重設密碼</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <a href="{{route('MemberResetPasswordPage', ['member_id'=>$details['member_id'], 'created_at'=> $details['created_at']])}}">
    {{route('MemberResetPasswordPage', ['member_id'=>$details['member_id'], 'created_at'=>$details['created_at']])}}
    </a>
    <p>Thank you</p>
</body>
</html>