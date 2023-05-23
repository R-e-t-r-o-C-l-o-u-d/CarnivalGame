import random
import time
import asyncio
from CarnivalGame.web.webcom import client

import serial


ser = serial.Serial("COM5", 9600)
print(ser.name)

# The chance of the direction changing in percent, 0-100
chanceOfDirectionChange = 5

# Speed is milliseconds between each new lamp being turned on
minSpeed = 300
maxSpeed = 1

# Level where the max speed is reached
maxLevel = 100

# Defining the variables that will be changed throughout the game
gameIsRunning = False
level = 0
currentDirection = 1

def main():
    global gameIsRunning
    while not gameIsRunning:
        print(get_speed())
        print(get_direction())
        time.sleep(0.2)
        data = ser.readline().decode('utf-8').strip()
        if data != "-1":
            if data == "start":
                gameIsRunning = True
                start_game()
                print("Game started")


def start_game():
    global gameIsRunning
    ser.write(f"speed {get_speed()}")
    while gameIsRunning:
        data = ser.readline().decode('utf-8').strip()
        if data != "-1":
            if data == "miss":
                gameIsRunning = False
                ser.write("speed 0".encode())
                asyncio.get_event_loop().run_until_complete(client.sendState(level * 100, 0)) # Send status code 0 to update database and show scoreboard.
            if data == "hit":
                global level
                global currentDirection
                level += 1
                ser.write(f"speed {get_speed() * currentDirection}")
                currentDirection = get_direction() * currentDirection
                asyncio.get_event_loop().run_until_complete(client.sendState(level * 100, 1)) # Send status code 1 to continue game

def get_speed():
    speed = (minSpeed - (minSpeed - maxSpeed) * (level / 100)) * random.normalvariate(1, 0.2)
    return min(minSpeed, max(maxSpeed, int(speed)))


def get_direction():
    if random.randint(0, 100) < chanceOfDirectionChange:
        return -1
    else:
        return 1

if __name__ == "__main__":
    main()
