import RPI.GPIO as GPIO
import json
import os
import requests
import time

def get_state():
    try:
        url = 'http://localhost/Control/GetCurrentState.php'
        response = requests.get(url)
        json_response = json.loads(response.text)
        payload = json_response['payload']
        return payload['state']
    except:
        return 'off'


GPIO.setmode(GPIO.BCM)

GPIO.cleanup()

try:
    GPIO.setup(23, GPIO.OUT)
    GPIO.setup(24, GPIO.OUT)
except:
    pass

while True:
    state = get_state()
    if state == 'contract':
        GPIO.output(23, GPIO.LOW)
        GPIO.output(24, GPIO.HIGH)
    elif state == 'expand':
        GPIO.output(23, GPIO.HIGH)
        GPIO.output(24, GPIO.LOW)
    else:
        GPIO.output(23, GPIO.LOW)
        GPIO.output(24, GPIO.LOW)
    time.sleep(0.5)