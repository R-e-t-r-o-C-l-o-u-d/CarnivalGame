import websockets
import json
import asyncio

def graceful_stop():
    pass

async def sendState(score, status):
    url = "ws://127.0.0.1:8000"
    async with websockets.connect(url) as ws:
        data = {
            "score": score,
            "status": status
        }
        
        await ws.send(json.dumps(data))
        await asyncio.get_event_loop().run_in_executor(None, graceful_stop)

asyncio.get_event_loop().run_until_complete(sendState(250, 1))
