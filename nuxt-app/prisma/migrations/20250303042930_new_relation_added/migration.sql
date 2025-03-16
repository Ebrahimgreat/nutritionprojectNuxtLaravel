/*
  Warnings:

  - Added the required column `userid` to the `Weight` table without a default value. This is not possible if the table is not empty.

*/
-- RedefineTables
PRAGMA defer_foreign_keys=ON;
PRAGMA foreign_keys=OFF;
CREATE TABLE "new_Weight" (
    "id" INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    "scaleWeight" REAL NOT NULL,
    "trendWeight" REAL NOT NULL,
    "userid" INTEGER NOT NULL,
    CONSTRAINT "Weight_userid_fkey" FOREIGN KEY ("userid") REFERENCES "User" ("id") ON DELETE RESTRICT ON UPDATE CASCADE
);
INSERT INTO "new_Weight" ("id", "scaleWeight", "trendWeight") SELECT "id", "scaleWeight", "trendWeight" FROM "Weight";
DROP TABLE "Weight";
ALTER TABLE "new_Weight" RENAME TO "Weight";
PRAGMA foreign_keys=ON;
PRAGMA defer_foreign_keys=OFF;
