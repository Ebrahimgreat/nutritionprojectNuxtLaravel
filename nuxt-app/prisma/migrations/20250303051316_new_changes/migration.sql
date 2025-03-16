/*
  Warnings:

  - Added the required column `user_id` to the `Nutrition` table without a default value. This is not possible if the table is not empty.
  - Added the required column `DOB` to the `User` table without a default value. This is not possible if the table is not empty.
  - Added the required column `age` to the `User` table without a default value. This is not possible if the table is not empty.
  - Added the required column `sex` to the `User` table without a default value. This is not possible if the table is not empty.

*/
-- RedefineTables
PRAGMA defer_foreign_keys=ON;
PRAGMA foreign_keys=OFF;
CREATE TABLE "new_Nutrition" (
    "id" INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    "calories" REAL,
    "protein" REAL,
    "carbs" REAL,
    "fat" REAL,
    "user_id" INTEGER NOT NULL,
    CONSTRAINT "Nutrition_user_id_fkey" FOREIGN KEY ("user_id") REFERENCES "User" ("id") ON DELETE RESTRICT ON UPDATE CASCADE
);
INSERT INTO "new_Nutrition" ("calories", "carbs", "fat", "id", "protein") SELECT "calories", "carbs", "fat", "id", "protein" FROM "Nutrition";
DROP TABLE "Nutrition";
ALTER TABLE "new_Nutrition" RENAME TO "Nutrition";
CREATE TABLE "new_User" (
    "id" INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    "email" TEXT NOT NULL,
    "name" TEXT,
    "sex" TEXT NOT NULL,
    "age" INTEGER NOT NULL,
    "DOB" DATETIME NOT NULL
);
INSERT INTO "new_User" ("email", "id", "name") SELECT "email", "id", "name" FROM "User";
DROP TABLE "User";
ALTER TABLE "new_User" RENAME TO "User";
CREATE UNIQUE INDEX "User_email_key" ON "User"("email");
PRAGMA foreign_keys=ON;
PRAGMA defer_foreign_keys=OFF;
