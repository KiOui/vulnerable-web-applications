import hashlib
from django.contrib.auth.hashers import BasePasswordHasher


class UnsaltedMD5PasswordHasher(BasePasswordHasher):
    """Reimplementation of Django's removed UnsaltedMD5PasswordHasher, for demo use only."""

    algorithm = "unsalted_md5"

    def encode(self, password, salt=None):
        return hashlib.md5(password.encode()).hexdigest()

    def verify(self, password, encoded):
        return encoded == hashlib.md5(password.encode()).hexdigest()

    def safe_summary(self, encoded):
        return {"algorithm": self.algorithm, "hash": encoded}
