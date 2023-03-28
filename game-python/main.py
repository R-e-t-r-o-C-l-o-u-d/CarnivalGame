import serial

ser = serial.Serial("COM5", 9600)
print(ser.name)

# The chance of the direction changing, 0-50
chanceOfDirectionChange = 0

# Speed is milliseconds between each new lamp being turned on
minSpeed = 500
maxSpeed = 1

# Level where the max speed is reached
maxLevel = 100

# Defining the variables that will be changed throughout the game
gameIsRunning = False
level = 0


def main():
    while True:

        data = ser.readline().decode('utf-8').strip()
        if data != "-1":
            print(data)
        else:
            print("No data")


def getSpeed(level):
    return maxSpeed + (maxSpeed - minSpeed) * (level / maxLevel)


if __name__ == "__main__":
    main()
