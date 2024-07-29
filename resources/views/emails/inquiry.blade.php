<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title> {{$setting->site_name}}</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
    </style>
</head>
<body style="font-family: sans-serif">
<div style="margin:0 auto; max-width:700px; width:100%;">
    <center>
        <div style="background:#FFF; padding:8px 0px; margin-bottom:5px;">
            <img src="{{asset('images/logo.png')}}" style="max-height: 40px" alt="company logo">
        </div>
    </center>
    <h1>{{$setting->site_name}}</h1>
    <table>
        <tr>
            <td><strong>Name</strong></td>
            <td>{{ $data['firstname']  }} {{ $data['lastname']  }}</td>
        </tr>
        <tr>
            <td><strong>Phone </strong></td>
            <td>{{ $data['contact'] }}</td>
        </tr>
        <tr>
            <td><strong>Email</strong></td>
            <td>{{ $data['email'] }}</td>
        </tr>
        <tr>
            <td><strong>Message</strong></td>
            <td>{{ $data['comment'] }}</td>
        </tr>
        <tr>
            <td><strong>Position</strong></td>
            <td>{{$data['position']}}</td>
        </tr>

        <tr>
            <td><strong>Company</strong></td>
            <td>{{$data['company']}}</td>
        </tr>
        <tr>
            <td><strong>Country</strong></td>
            <td>{{$data['country']}}</td>
        </tr>
        <tr>
            <td><strong>Industry</strong></td>
            <td>{{$data['industry']}}</td>
        </tr>
        <tr>
            <td><strong>Revenue</strong></td>
            <td>{{$data['revenue']}}</td>
        </tr>
        <tr>
            <td><strong>RFP</strong></td>
            <td><img src="{{ $message->embed(public_path().'images/logo.png') }}">
            </td>
        </tr>

    </table>
    <p>Thank You</p>
</div>
</body>
</html>
