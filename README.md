# URL短縮サービス

## サービスの趣旨
このサービスは、長いURLを短くすることで使いやすくすることを目的としたサービスです。

具体的には、以下のように長いURLを短縮することができます。

### 元のURLの例
> https://example.com/?text=%E3%82%B5%E3%83%B3%E3%83%97%E3%83%AB%E3%81%AEURL%E3%81%A7%E3%81%99

### 短縮したURLの例
> https://short.taketo-u.net/bcWu8F

※なお、この短縮機能は、このサービスが発行した短いURLへのHTTPリクエストを受けて、元のURLへリダイレクトすることによって実現します。

## サービスの機能要件
 - 短縮URLを発行し、その内容を記録すること。
 - 短縮URLへのアクセスをリダイレクトすること。

## サービスの非機能要件
 - ホットデプロイが行われること
 - 

## 環境
|||
|---|---|
|言語|PHP、JavaScript|
|データベース|mySQL|
|バージョン管理|Git|
|開発環境|xampp|
|デプロイ|deployer|
