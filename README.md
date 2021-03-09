# 映画館の予約システム

---

## どんなシステム？

上映作品の一覧を見ることができ、**会員様**は用意された日時
などから座席を予約することができるシステムです

## 各種情報

### 工程数

|      | 小規模(1) | 大規模(2) |  合計  |
| ---- | :-------: | :-------: | :----: |
| 静的 |     3     |     1     |   5    |
| 動的 |     1     |     5     |   11   |
| 内部 |     2     |     1     |   4    |
|      |           |           |
|      |           | **総計**  | **20** |

### 各ペ－ジと担当など(予定)

- imai1121
  -
  - home.php (Top ページ)
  - date.php (日付用 form)
  - time.php (時間用 form)
  - nav.php (ナビゲーションバー)
- Honda-Tadakatu
  -
  - check.php (登録前の最終確認画面)
  - login.php (ログイン form)
  - login_success.php (ログイン可否)
  - db_conect.php (DB 接続)
- ruka0315
  -
  - contents.php (映画一覧)
  - logout.php (ログアウト画面)
- tamaki1121
  -
  - seat.php (座席用 form)
  - seat_succsess.php (登録)
  - データベース関連
