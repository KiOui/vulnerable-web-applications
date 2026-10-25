from pydantic import BaseModel, ConfigDict
from typing import Optional


class UserCreate(BaseModel):
    name: str
    email: str
    password: str
    role: str

    model_config = ConfigDict(
        json_schema_extra={
            "example": {
                "name": "Alice",
                "email": "alice@example.com",
                "password": "password123",
                "role": "user",
            }
        }
    )


class UserUpdate(BaseModel):
    name: Optional[str] = None
    email: Optional[str] = None
    password: Optional[str] = None
    role: Optional[str] = None

    model_config = ConfigDict(
        json_schema_extra={
            "example": {
                "name": "Alice",
                "email": "alice@example.com",
                "password": "newpassword123",
                "role": "admin",
            }
        }
    )


class EnergyCreate(BaseModel):
    usage: float
    production: float

    model_config = ConfigDict(
        json_schema_extra={
            "example": {
                "usage": 2.5,
                "production": 4.0,
            }
        }
    )
