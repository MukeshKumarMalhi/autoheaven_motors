<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <h2>Sell your car</h2>
    <p>ID : {{ $form_data['id'] }}</p>
    <p>Vehicle Type : {{ $form_data['vehicle_type']  }}</p>
    <p>Make : {{ $form_data['company']  }}</p>
    <p>Model : {{ $form_data['model']  }}</p>
    <p>Vehicle Reg : {{ $form_data['vehicle_reg']  }}</p>
    <p>Mileage : {{ $form_data['mileage']  }}</p>
    <p>Service History : {{ $form_data['service_history']  }}</p>
    <p>Vehicle come with specify : {{ $form_data['vehicle_come_with_specify']  }}</p>
    <p>Vehicle Condition : {{ $form_data['vehicle_condition']  }} damage</p>
    <p>Vehicle damage condition description : {{ $form_data['vehicle_damage_condition_description']  }}</p>
    <p>Full Name : {{ $form_data['full_name']  }}</p>
    <p>Phone Number : {{ $form_data['phone_number']  }}</p>
    <p>Email Address : {{ $form_data['email_address']  }}</p>
  </body>
</html>
