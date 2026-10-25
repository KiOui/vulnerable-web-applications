import asyncio
import os
from datetime import datetime, timedelta, timezone
import uuid

from pymongo import AsyncMongoClient

USERS = [
    {
        "name": "James",
        "email": "james@hacktraining.nl",
        "password": "password1",
        "role": "user",
    },
    {
        "name": "Michael",
        "email": "michael@hacktraining.nl",
        "password": "Welkom01!",
        "role": "user",
    },
    {
        "name": "Robert",
        "email": "robert@hacktraining.nl",
        "password": "Zomer2024",
        "role": "user",
    },
    {
        "name": "Flag",
        "email": "flag@hacktraining.nl",
        "password": "hacktraining{6c4ad7785755269663bc010f21abf6d5}",
        "role": "admin",
    },
]

ENERGY_VALUES = [
    (150.5, 75.3),
    (145.2, 80.1),
    (160.7, 70.6),
    (155.4, 65.4),
    (170.9, 60.2),
    (165.6, 55.8),
    (180.1, 50.4),
    (175.8, 45.2),
    (190.3, 40.1),
    (185.0, 35.0),
    (200.5, 30.0),
    (195.2, 25.0),
    (210.7, 20.0),
    (205.4, 15.0),
    (220.9, 10.0),
    (215.6, 5.0),
    (230.1, 0.0),
    (225.8, 0.0),
    (240.3, 0.0),
    (235.0, 0.0),
    (250.5, 0.0),
    (245.2, 0.0),
    (260.7, 0.0),
    (255.4, 0.0),
]


async def initialize_database():
    mongo_url = os.getenv("MONGO_URL", "mongodb://localhost:27017/energyapi")
    client = AsyncMongoClient(mongo_url, serverSelectionTimeoutMS=30000)
    database = client.get_default_database(default="energyapi")

    try:
        collections = set(await database.list_collection_names())

        if "users" not in collections:
            await database["users"].insert_many(USERS)

        if "energy" not in collections:
            start = datetime(2024, 1, 1, tzinfo=timezone.utc)
            energy_data = [
                {
                    "id": str(uuid.uuid4()),
                    "timestamp": start + timedelta(hours=hour),
                    "usage": usage,
                    "production": production,
                }
                for hour, (usage, production) in enumerate(ENERGY_VALUES)
            ]
            await database["energy"].insert_many(energy_data)
    finally:
        await client.close()


if __name__ == "__main__":
    asyncio.run(initialize_database())
