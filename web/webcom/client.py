import websockets
import json
import asyncio

async def listen(name, score, status):
    url = "ws://127.0.0.1:8000"
    async with websockets.connect(url) as ws:
        data = {
            "name": name,
            "score": score,
            "status": status
        }
        
        await ws.send(json.dumps(data))
        await asyncio.get_event_loop().run_in_executor(None, exit)

asyncio.get_event_loop().run_until_complete(listen("Bert Fjart", 999, 1))
