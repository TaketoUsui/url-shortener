# URL短縮サービス

## サービスの趣旨
このサービスは、長いURLを短くすることで使いやすくすることを目的としたサービスです。

具体的には、以下のように長いURLを短縮することができます。

### 元のURLの例
> https://example.example/?text=%E3%82%B5%E3%83%B3%E3%83%97%E3%83%AB%E3%81%AEURL%E3%81%A7%E3%81%99

### 短縮したURLの例
> https://ex.example/A8g7Qn

※なお、この短縮機能は、このサービスが発行した短いURLへのHTTPリクエストを受けて、元のURLへリダイレクトすることによって実現します。

## サービスの機能要件
 - 与えられるURLに対してユニークな短縮URLを発行し、その対応関係を保存する。
 - 発行済みの短縮URLへのリクエストに対して、リダイレクトを返す。

## サービスの非機能要件
 - 短縮URLの発行が、複数のクライアントから同時に要求された場合でも、短縮URLの一意性を保証すること。
 - リダイレクトが素早く行なわれること。

## 環境
言語：PHP、JavaScript
データベース：MariaDB
リポジトリ：Git
開発環境：xampp
