<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <h2>Review</h2>
    <p>Rating : {{ $form_data['rating_number']  }} stars</p>
    <p>Review title : {{ $form_data['rating_title']  }}</p>
    <p>Review Message : {{ $form_data['rating_desc']  }}</p>
    <p>Full Name : {{ $form_data['full_name']  }}</p>
    <p>Email Address : {{ $form_data['email']  }}</p>
  </body>
</html>
