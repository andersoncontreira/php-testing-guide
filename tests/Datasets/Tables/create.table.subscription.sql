CREATE TABLE IF NOT EXISTS subscription (
      id      INTEGER PRIMARY KEY AUTOINCREMENT,
      name TEXT,
      locale TEXT,
      document TEXT,
      documentType TEXT,
      email TEXT,
      password TEXT,
      address TEXT,
      uuid TEXT
-- UNIQUE(document)
)