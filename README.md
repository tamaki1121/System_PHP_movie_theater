# 映画館の予約システム

## どんなシステム？

上映作品の一覧を見ることができ、**会員様**は用意された日時
などから座席を予約することができるシステムです

## 各種情報

### 工程数
#### 予定
|      | 小規模(1) | 大規模(2) |  合計  |
| ---- | :-------: | :-------: | :----: |
| 静的 |     3     |     1     |   5    |
| 動的 |     1     |     5     |   11   |
| 内部 |     2     |     1     |   4    |
|      |           |           |
|      |           | **総計**  | **20** |

#### 実際
|      | 小規模(1) | 大規模(2) |  合計  |
| ---- | :-------: | :-------: | :----: |
| 静的 |     1     |     4     |   5    |
| 動的 |     1     |     10    |   11   |
| 内部 |     1     |     4     |   5    |
|      |           |           |
|      |           | **総計**  | **21** |

### 各ペ－ジと担当など(予定)

- imai1212
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

### 各ペ－ジと担当など(実際)

- imai1212
  -
  - home.php (Top ページ) 大 静的ページ
  - date.php (日付用 form) 大 動的ページ
  - nav.php (ナビゲーションバー) 小 内部ページ
- Honda-Tadakatu
  -
  - check.php (登録前の最終確認画面) 小 静的ページ
  - login.php (ログイン form) 小 静的ページ
  - login_success.php (ログイン可否) 大 動的ページ
  - db_conect.php (DB 接続) 大 内部ページ
- ruka0315
  -
  - contents.php (映画一覧) 大 動的ページ
  - logout.php (ログアウト画面) 大 静的ページ
- tamaki1121
  -
  - seat.php (座席用 form) 大 動的ページ
  - seat_succsess.php (登録) 大 動的ページ
  - データベース関連 大 内部ページ
