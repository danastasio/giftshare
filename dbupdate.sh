echo "alter table items add column deleted_at DATETIME;" | sqlite3 database/testing.db
echo "alter table items add column purchased BOOLEAN;" | sqlite3 database/testing.db
echo "alter table user_users add column deleted_at DATETIME;" | sqlite3 database/testing.db
echo "alter table users add column deleted_at DATETIME;" | sqlite3 database/testing.db
