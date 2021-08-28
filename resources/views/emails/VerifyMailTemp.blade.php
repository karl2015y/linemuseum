<!DOCTYPE html>
<html>
<head>
    <title>電子信箱驗證</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <a href="{{route('MemberVerifyMail', ['member_id'=>$details['member_id'], 'created_at'=> $details['created_at']])}}">
    {{route('MemberVerifyMail', ['member_id'=>$details['member_id'], 'created_at'=>$details['created_at']])}}
    </a>
    <p>Thank you</p>
</body>
</html>