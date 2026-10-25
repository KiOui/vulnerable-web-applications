import os
from pymongo import AsyncMongoClient

# Get the MongoDB connection string from the environment variable
MONGO_DETAILS = os.getenv("MONGO_URL", "mongodb://localhost:27017/energyapi")

client = AsyncMongoClient(MONGO_DETAILS)

database = client.get_default_database(default="energyapi")
user_collection = database.get_collection("users")
energy_collection = database.get_collection("energy")  # Voeg deze regel toe


def get_db():
    return database
