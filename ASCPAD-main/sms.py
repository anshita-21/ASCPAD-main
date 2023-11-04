from twilio.rest import Client

def send_sms(to, message):

    # Your Account SID from twilio.com/console
    account_sid = "AC675fab3e52fc8779648fb8cee37fbffb"
    # Your Auth Token from twilio.com/console
    auth_token = "c73e32f1c1576353440da3faa8dfabeb"

    client = Client(account_sid, auth_token)

    message = client.messages.create(
        to=to,
        from_="+12162382591",
        body=message
    )

    print(f"SMS sent to {to} with message: {message.body}")

# Example usage
send_sms("+919106311773", "Your vehicle has been towed by traffic police for parking in no parking area. Get more details on website.")