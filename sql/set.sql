/*
##################################################
# 映画館用データベースのセッティング  ver1          #  
# 作成 izutamaki                                 #
##################################################
# データベース名 movie_theater_site
# ユーザ名 myuser
# ホスト名 %
# パスワード　hoge
# movie_theater_siteのテーブル全てに権限を持ちます
##################################################
# 作成されるテーブル
#
# テーブル名 site_user
# カラム名 id email password
# ユーザアカウントテーブル、emailは重複不可。
#
# テーブル名 movie_work
# カラム名 id name description url
# 映画作品の情報。
#
# テーブル名 movie_plan
# カラム名 id movie_work date_time room_name
# 配信予定。
#
# テーブル名 seat
# カラム名 id movie_plan_id number vacant
# 座席情報。
#
# テーブル名 purchase
# カラム名 id site_user_id
# 購入歴、購入するごとに記録される情報。
#
# テーブル名 reserve
# カラム名 purchase_id seat_id
# 席ごとの購入歴。
##################################################
# 不具合など
#
# room_nameはテーブルを新しく作る必要が出てくるかも
# しれません。
#
# movie_planはレコードが多くなるため将来的に分割する
# 必要があります。
################################################## 
# 編集履歴 
#
# 21/03/06 ver1 完成
#
################################################## 
*/
-- データベース作成
-- IF NOT EXISTSは存在しないなら
CREATE DATABASE IF NOT EXISTS movie_theater_site;

-- これから使用するデータベースを明示
USE movie_theater_site;

-- アカウントを作成
-- CREATE USER [ユーザ名]@[ホスト名] IDENTIFIED BY [パスワード]
CREATE USER IF NOT EXISTS 'myuser'@'%' IDENTIFIED BY 'hoge';

-- 権限を付与
-- GRANT [権限] ON [データベース名].[テーブル名] TO アカウント情報
GRANT ALL ON movie_theater_site.* TO 'myuser'@'%' IDENTIFIED BY 'hoge';

-- 権限を再読み込み　実際、必要ないらしい


-- テーブルがすでにあったら削除
-- リレーションがある場合、消す順番に注意
DROP TABLE IF EXISTS reserve;
DROP TABLE IF EXISTS purchase;
DROP TABLE IF EXISTS seat;
DROP TABLE IF EXISTS movie_plan;
DROP TABLE IF EXISTS movie_work;
DROP TABLE IF EXISTS site_user;

CREATE TABLE site_user(
    id INT auto_increment PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL
);
CREATE TABLE movie_work(
    id INT auto_increment PRIMARY KEY,
    name VARCHAR(160) NOT NULL,
    description VARCHAR(400) NOT NULL,
    url VARCHAR(255) NOT NULL
);
CREATE TABLE movie_plan(
    id INT auto_increment PRIMARY KEY,
    movie_work_id INT NOT NULL,
    date_time DATETIME NOT NULL,
    room_name VARCHAR(20) NOT NULL,
    FOREIGN KEY(movie_work_id) REFERENCES movie_work(id)
);
CREATE TABLE seat(
    id INT auto_increment PRIMARY KEY,
    movie_plan_id INT NOT NULL,
    number VARCHAR(8) NOT NULL,
    vacant BOOLEAN NOT NULL,
    INDEX movie_plan_index(movie_plan_id),
    FOREIGN KEY(movie_plan_id) REFERENCES movie_plan(id)
);
CREATE TABLE purchase(
    id INT auto_increment PRIMARY KEY,
    site_user_id INT NOT NULL,
    FOREIGN KEY(site_user_id) REFERENCES site_user(id)
);
CREATE TABLE reserve(
    purchase_id INT,
    seat_id INT,
    PRIMARY KEY(purchase_id, seat_id),
    FOREIGN KEY(purchase_id) REFERENCES purchase(id),
    FOREIGN KEY(seat_id) REFERENCES seat(id)
);
