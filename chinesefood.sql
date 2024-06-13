-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-06-13 10:14:19
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `chinesefood`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- テーブルのデータのダンプ `comments`
--

INSERT INTO `comments` (`id`, `food_id`, `name`, `comment`, `time`) VALUES
(1, 123, '77', '辛い', '2024-06-13 01:25:45'),
(2, 123, '11', '辛い11', '2024-06-13 01:30:48');

-- --------------------------------------------------------

--
-- テーブルの構造 `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `foodname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(100) NOT NULL,
  `foodimage` varchar(100) NOT NULL,
  `introduction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- テーブルのデータのダンプ `foods`
--

INSERT INTO `foods` (`id`, `foodname`, `type`, `foodimage`, `introduction`, `flag`) VALUES
(121, '木須肉', 'lc', 'mxr.jpg', 'キクラゲと豚肉と卵を炒めた料理であるが、他の野菜を加えることも珍しくない。', 1),
(125, '糖醋鯉魚', 'lc', 'tcly.jpg', '山東料理を代表する名菜。糖醋＝甘酢あん、鯉魚＝コイ。すなわち内臓処理をしたコイをまるごと美味しいフリッターにして、とろみがいつまでも切れない見事な美味の甘酢あんで仕上げたもの。刻みにんにくの味がしびれる美味しさ。', 1),
(126, '水煮牛肉', 'cc', 'sznr.jpg', '水煮牛肉とは、牛肉や野菜を油たっぷりの汁で煮込んだ中国四川省の料理です。唐辛子や花椒の風味がきいていて、ごはんとの相性抜群！仕上げに熱々に熱した油をまわしかけて、香ばしさを引き出す。\r\n', 1),
(127, '魚香茄子', 'cc', 'yxqz.jpg', '茄子のピリ辛煮込みもの。使用された材料は茄子、豚ひき肉、白ネギ、にんにく、生姜です。調味料は豆板醬、酒、醤油、チューニャン、醤油、砂糖、鶏がらスープ、水溶き片栗粉が必要。', 1),
(128, '腸粉', 'yc', 'cf.JPG', '腸粉とは、動物の腸を粉にしたものではない。「粉」は、料理用語では、粉にしてから水に溶かして、さらに加工した食品のこと。米の麺、つまりベトナムのフォーは中国語で「粉絲」と書く。「腸」は、動物の腸を材料にしたのではなく、その形が腸（チャン）に似ているという意味です。腸粉（チョンフェン)とは、米の粉を溶かして薄く延ばし、巻いて中に具を入れてタレをかけた料理。具は、牛肉、チャーシュー、海老が一般的。', 1),
(129, '煲仔飯(土鍋飯)', 'yc', '', '土鍋を使って一人前ずつの白米を炊き、炊きあがりの直前に、下味を付けた具を乗せて蓋をして蒸し、醤油ベースのたれをかけて完成させるご飯料理である。通常片手餅の土鍋を用い、具には、鶏肉、牛肉、広東式の干しソーセージ、カエル、魚、シイタケ、ネギなどのほか、オプションで卵を入れることもできる。炊きたてのものが食べられ、具も、本来の持ち味を生かすことができるが、米を研いでおいても、炊くのに30分ほどかかるのが難点である。', 1),
(130, '腌鮮鱖魚（臭鱖魚）', 'hc', 'cgy.jpg', '塩漬けケツギョの煮物。地元の言葉で「塩漬け」は臭いという意味である。臭ケツギョはとても臭いですが食べると美味しい。ケツギョ本来の味を保つために骨と肉が分かれていて食べやすくなっている。 ', 1),
(131, '筍絲炒肉絲', 'hc', 'yscrs.jpg', '安徽省は海に面しておらず、野の幸山の幸を上手に使う料理が多い。民家の軒先では筍（中国語で笋）を干す光景をよく見かける。そんな滋味溢れる野の筍を肉の細切り（中国語で肉丝）や水分の少ない豆腐の細切りと共に醤油ベースで炒めたこの料理。心底美味しいと思った。乾物の旨み最高。安徽料理は醤油と素材の味の組合せが、日本人の味覚に非常に合うよ。 ', 1),
(132, '佛跳牆', 'mc', '', '乾物を主体とする鮑や貝柱、エビ、椎茸などの高級食材を数日かけて調理する福建料理の伝統的な高級スープ。名前の由来は「あまりの美味しそうな香りに修行僧ですらお寺の塀を飛び越えて来る」という詞にあるとされる。 ', 1),
(134, '福州鱼丸', 'mc', 'fzyw.jpg', '福州鱼丸は、魚のすり身から作った魚団子スープ。外側の白い皮は、うなぎやサメが使用されることが多い。中身は豚肉が使われることが多く、魚のうま味を感じながら、とろとろの豚肉も同時に楽しめる。団子が入っているスープは魚介系のあっさりスープで、優しい味わいが特徴。', 1),
(135, '塩水鴨', 'sc', 'ysy.jpg', 'アヒル肉の塩味付けの煮込みである。江蘇を生きたまま離れられるアヒルは1匹もいないという言い方があるが、これはアヒルの江蘇料理における重要さを十分に現している。江蘇の人はアヒルを食べることが大好きで、自然にアヒルを調理することも得意である。', 1),
(136, '油爆蝦', 'sc', 'ybx.jpg', 'エビのあんかけ炒めである。この料理は料理人の火加減に対するコントロールが大切で、寸分も違わないように工夫しないといけない。エビの殻を揚げてからカリカリにしなければならないし、あまり強火にしてエビを揚げすぎて焦げることもできないようにしなければならない。エビの殻がはじける度合いを耳で聞き取れる料理人もいるという。', 1),
(137, '剁椒魚頭', 'xc', 'djyt.jpg', '大きな川魚の頭を開いて、剁椒と呼ばれる唐辛子のみじん切りを発酵させた調味料を大量にかけて蒸した料理である。湖南では、残ったソースを麺にかけて食べている。 ', 1),
(138, '臭豆腐', 'xc', 'cdf.jpg', '漬け汁は真っ黒で、白い豆腐が黒く変色してしまうが、これも揚げて唐辛子の激辛タレをかけて食べる。', 1),
(140, '龍井蝦仁', 'zc', '', 'エビの龍井茶葉炒めである。', 1),
(141, '叫化鶏', 'zc', 'jhj.jpg', '鶏を蓮の葉でくるんだのち、さらに土で全体を包み、丸ごと炉で蒸し焼きにする料理です。蓮の葉でくるんでいることで、肉は柔らかく、味が逃げず濃厚なうまみが出る上、蓮の香りも加わって、風味豊かなことが特徴。', 1);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
