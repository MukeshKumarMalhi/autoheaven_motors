<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <h2>Car Enquiry</h2>
    <p>Car Id : {{ $form_data['car_id']  }}</p>
    <p>Make : {{ $form_data['category_name']  }}</p>
    <p>Model : {{ $form_data['model']  }} {{ $form_data['version']  }} {{ $form_data['model_year']  }}</p>
    <p>Full Name : {{ $form_data['name']  }}</p>
    <p>Phone Number : {{ $form_data['phone']  }}</p>
    <p>Email Address : {{ $form_data['email']  }}</p>
    <p>Message : {{ $form_data['info_message']  }}</p>
  </body>
</html>
