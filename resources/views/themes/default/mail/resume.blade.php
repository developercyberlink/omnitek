<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> {{$setting->site_name}}</title>
<style>
table {
    border-collapse: collapse;
	width:100%;
}
table, th, td {
    border: 1px solid #ddd;
	padding:8px;
}
</style>
</head>
<body style="font-family: sans-serif">
<div style="margin:0 auto; max-width:700px; width:100%;">
<center>
<div style="background:#FFF; padding:8px 0px; margin-bottom:5px;">
<!-- <img src="{{ asset(env('PUBLIC_PATH').'themes-assets/images/logo.png') }}" /> -->
</div>
</center>
<h1> {{$setting->site_name}} </h1>
<table>
  <tr>
    <td><strong>First Name </strong></td>
    <td>{{ $first_name }}</td> 
  </tr>
  <tr>
    <td><strong>Last Name</strong></td>
    <td>{{ $last_name }}</td>
  </tr>
  <tr>
    <td><strong>Email Address</strong></td>
    <td>{{ $email_address }}</td>
  </tr>
  <tr>
    <td><strong>Phone Number </strong></td>
    <td>{{ $phone }}</td>
  </tr>  
</table>
<p>Thank You</p>
</div>
</body>
</html>
