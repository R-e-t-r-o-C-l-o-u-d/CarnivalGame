import websockets
import json
import asyncio

class User():
    def __init__(self, user):
        self.user = user
        self.score = 0

async def sendState(name, score, status):
    url = "ws://127.0.0.1:8000"
    async with websockets.connect(url) as ws:
        data = {
            "name": name,
            "score": score,
            "status": status
        }
        
        await ws.send(json.dumps(data))
        await asyncio.get_event_loop().run_in_executor(None, exit)

asyncio.get_event_loop().run_until_complete(sendState("Bert Fjart", 999, 1))
