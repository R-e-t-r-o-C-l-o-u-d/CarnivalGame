import websockets
import asyncio
import threading

ws = websockets.connect('ws://127.0.0.1:8000')
def receive_ws(ws):
    while True:
        try:
            result = ws.recv()
        except:
            break
        print(message)

receive_ws(ws)