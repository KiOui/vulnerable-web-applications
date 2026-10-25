from fastapi import FastAPI, HTTPException, Depends, Query, Body
from app.database import user_collection, energy_collection
from app.models import UserModel, EnergyModel
from app.auth import (
    create_access_token,
    get_current_active_user,
    get_current_active_admin,
)
from bson.objectid import ObjectId
import os
from typing import Any, List
import random
from datetime import datetime, timedelta
from fastapi.openapi.utils import get_openapi
import uuid

app = FastAPI()


def custom_openapi():
    if app.openapi_schema:
        return app.openapi_schema

    openapi_schema = get_openapi(
        title="Energy API Backend",
        version="1.0.0",
        description="API for managing energy data",
        routes=app.routes,
    )

    openapi_schema["components"]["securitySchemes"] = {
        "BearerAuth": {
            "type": "http",
            "scheme": "bearer",
            "bearerFormat": "JWT",
        }
    }

    for path in openapi_schema["paths"].values():
        for method in path.values():
            method["security"] = [{"BearerAuth": []}]

    app.openapi_schema = openapi_schema
    return openapi_schema


app.openapi = custom_openapi


# Update the MongoDB connection string to use an environment variable
MONGO_DETAILS = os.getenv("MONGO_URL", "mongodb://localhost:27017/energyapi")


@app.post("/energy_data/")
async def generate_energy_data(entries: int = 100):
    for _ in range(entries):
        energy_data = {
            "id": str(uuid.uuid4()),
            "timestamp": datetime.now() - timedelta(minutes=random.randint(0, 10000)),
            "usage": random.uniform(0.5, 5.0),  # kWh
            "production": random.uniform(0.0, 10.0),  # kWh
        }
        await energy_collection.insert_one(energy_data)
    return {"message": f"{entries} energy data entries created successfully."}


@app.get("/energy_data/", response_model=List[EnergyModel])
async def get_energy_data(limit: int = 100):
    energy_data = []
    async for data in energy_collection.find().sort("timestamp", -1).limit(limit):
        data["_id"] = str(data["_id"])  # Convert ObjectId to str
        energy_data.append(EnergyModel(**data))
    return energy_data


@app.get("/users/")
async def get_all_users():
    users = []
    # Filter by role and select only the name field
    async for user in user_collection.find({"role": "user"}, {"name": 1, "_id": 0}):
        users.append(user["name"])
    return users


@app.get("/admin/")
async def get_admin_users(current_user: dict = Depends(get_current_active_admin)):
    users = []
    async for user in user_collection.find():
        user["_id"] = str(user["_id"])  # Convert ObjectId to str
        users.append(UserModel(**user))
    return users


@app.get("/users/{user_id}")
async def get_user_by_id(
    user_id: str, current_user: dict = Depends(get_current_active_user)
):
    user = await user_collection.find_one({"_id": ObjectId(user_id)})
    if user:
        user["_id"] = str(user["_id"])  # Convert ObjectId to str
        return UserModel(**user)
    raise HTTPException(status_code=404, detail="User not found")


# NoSQL Injection vulnerability
@app.get("/search/")
async def search_users(
    name: str = Query(None), current_user: dict = Depends(get_current_active_admin)
):
    # Vulnerable to NoSQL Injection
    query = {"name": {"$regex": name}} if name else {}
    users = []
    async for user in user_collection.find(query):
        user["_id"] = str(user["_id"])  # Convert ObjectId to str
        users.append(UserModel(**user))
    return users


# NoSQL Injection vulnerability
@app.post("/login/")
async def login(name: str = Body(...), password: Any = Body(...)):
    if not name or not password:
        raise HTTPException(
            status_code=400, detail="Name and password must be provided"
        )
    if isinstance(password, str):
        user = await user_collection.find_one(
            {"name": {"$regex": name}, "password": password}
        )
    else:
        user = await user_collection.find_one(
            {"name": {"$regex": name}, "password": password}
        )
    if user:
        token = create_access_token(
            {
                "sub": user["name"],
                "role": user["role"],
                "flag": "hacktraining{50e07152e245ee84e57b8bf56b5e2173}",
            }
        )
        return {"access_token": token, "token_type": "bearer"}
    raise HTTPException(status_code=401, detail="Invalid credentials")
