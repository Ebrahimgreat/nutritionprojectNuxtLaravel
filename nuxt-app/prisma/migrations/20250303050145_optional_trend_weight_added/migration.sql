/*
  Warnings:

  - You are about to drop the column `userid` on the `Weight` table. All the data in the column will be lost.
  - Added the required column `user_id` to the `Weight` table without a default value. This is not possible if the table is not empty.

*/
-- RedefineTables
PRAGMA defer_foreign_keys=ON;
PRAGMA foreign_keys=OFF;
CREATE TABLE "new_Weight" (
    "id" INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    "scaleWeight" REAL NOT NULL,
    "trendWeight" REAL,
    "user_id" INTEGER NOT NULL,
    CONSTRAINT "Weight_user_id_fkey" FOREIGN KEY ("user_id") REFERENCES "User" ("id") ON DELETE RESTRICT ON UPDATE CASCADE
);
INSERT INTO "new_Weight" ("id", "scaleWeight", "trendWeight") SELECT "id", "scaleWeight", "trendWeight" FROM "Weight";
DROP TABLE "Weight";
ALTER TABLE "new_Weight" RENAME TO "Weight";
PRAGMA foreign_keys=ON;
PRAGMA defer_foreign_keys=OFF;
