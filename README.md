# TIGER BLOG

現代的なWordPressテーマ - LION BLOGをベースに最新のWordPress標準に対応

## 概要

TIGER BLOGは、人気のあったLION BLOG（2018年版）を最新のWordPress標準に対応させた現代的なテーマです。TypeScript、Vite、Vitestを使用した堅牢な開発環境を備えています。

### 主な特徴

- ✅ **最新WordPress対応**: WordPress 6.0以降、PHP 7.4以降に対応
- ✅ **ブロックエディタ完全対応**: Gutenbergエディタとtheme.jsonによる柔軟なカスタマイズ
- ✅ **TypeScript**: 型安全性による堅牢なコード
- ✅ **モダンビルドツール**: Viteによる高速な開発とビルド
- ✅ **テストカバレッジ**: Vitestによる自動テスト（目標80%以上）
- ✅ **レスポンシブデザイン**: モバイルファーストの美しいデザイン
- ✅ **SEO最適化**: schema.org、OGP対応
- ✅ **パフォーマンス**: 最適化されたアセット読み込み

## 必要要件

- WordPress 6.0以降
- PHP 7.4以降
- Node.js 18.0以降
- npm 9.0以降

## インストール

### 1. テーマのインストール

```bash
cd /path/to/wordpress/wp-content/themes/
git clone <repository-url> tiger-blog
cd tiger-blog
```

### 2. 依存関係のインストール

```bash
npm install
```

### 3. ビルド

#### 開発モード（ウォッチモード）
```bash
npm run dev
```

#### 本番ビルド
```bash
npm run build
```

### 4. WordPressでテーマを有効化

WordPress管理画面から「外観」→「テーマ」でTIGER BLOGを有効化してください。

## 開発

### プロジェクト構造

```
tiger-blog/
├── src/                      # TypeScriptソースコード
│   ├── main.ts              # エントリーポイント
│   ├── modules/             # モジュール
│   │   ├── navigation.ts    # ナビゲーション機能
│   │   ├── search.ts        # 検索機能
│   │   └── scroll.ts        # スクロール機能
│   ├── types/               # 型定義
│   │   └── wordpress.d.ts   # WordPress型定義
│   ├── styles/              # SCSS
│   │   └── main.scss        # メインスタイル
│   └── __tests__/           # テストファイル
│       ├── navigation.test.ts
│       ├── search.test.ts
│       └── scroll.test.ts
├── assets/                   # ビルド成果物（自動生成）
│   ├── main.js
│   └── main.css
├── css/                      # 既存CSS
├── img/                      # 画像リソース
├── fonts/                    # フォント
├── functions.php             # テーマ機能
├── style.css                 # テーマヘッダー
├── theme.json                # テーマ設定
└── ...                       # その他のテンプレートファイル
```

### 開発コマンド

```bash
# 開発サーバー起動（ウォッチモード）
npm run dev

# 本番ビルド
npm run build

# プレビュー
npm run preview

# テスト実行
npm run test

# テストカバレッジ
npm run test:coverage

# ウォッチモードでテスト
npm run test:watch

# TypeScript型チェック
npm run type-check

# ESLintチェック
npm run lint

# ESLint自動修正
npm run lint:fix

# Prettierフォーマット
npm run format
```

### コーディング規約

- **TypeScript**: 厳格な型チェックを有効化
- **ESLint**: TypeScript ESLint推奨ルールを使用
- **Prettier**: コードフォーマットを統一
- **テスト**: 新機能には必ずテストを追加

## テスト

### テストの実行

```bash
# すべてのテストを実行
npm run test

# カバレッジレポート付き
npm run test:coverage
```

### テストファイルの追加

`src/__tests__/`ディレクトリに`*.test.ts`ファイルを追加してください。

例:
```typescript
import { describe, it, expect } from 'vitest';
import { MyModule } from '../modules/my-module';

describe('MyModule', () => {
  it('should work correctly', () => {
    const module = new MyModule();
    expect(module.doSomething()).toBe(true);
  });
});
```

## カスタマイズ

### カラーパレット

`theme.json`でカラーパレットをカスタマイズできます。

### カスタマイザー

WordPress管理画面の「外観」→「カスタマイズ」から以下を設定できます:

- ロゴ画像
- メインビジュアル
- レイアウト設定
- 広告設定
- ソーシャルメディア設定

## ライセンス

GNU GENERAL PUBLIC LICENSE Version 2

## クレジット

- 元テーマ: LION BLOG by FIT(フィット)
- 現代化: TIGER BLOG

## サポート

問題や質問がある場合は、GitHubのIssuesで報告してください。
