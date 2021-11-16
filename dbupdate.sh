echo "alter table items add column deleted_at DATETIME;" | toolbox run sqlite3 database/database.db
echo "alter table user_users add column deleted_at DATETIME;" | toolbox run sqlite3 database/database.db
