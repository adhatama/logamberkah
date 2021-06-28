BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "harga_dasar_kami_beli" (
	"date"	TEXT,
	"type"	TEXT,
	"data"	TEXT
);
CREATE TABLE IF NOT EXISTS "harga_dasar_kami_jual" (
	"date"	TEXT,
	"type"	TEXT,
	"data"	TEXT
);
CREATE TABLE IF NOT EXISTS "harga_kami_beli" (
	"date"	TEXT,
	"type"	TEXT,
	"data"	TEXT
);
CREATE TABLE IF NOT EXISTS "harga_kami_jual" (
	"date"	TEXT,
	"type"	TEXT,
	"data"	TEXT
);
INSERT INTO "harga_dasar_kami_beli" VALUES ('2021-06-14 13:03','emas-certicard','{"harga":855000,"date":"2021-06-14 13:03"}');
INSERT INTO "harga_dasar_kami_beli" VALUES ('2021-06-22 02:47','emas-certicard','{"harga":829000,"date":"2021-06-22 02:47"}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":0.5,"harga":522500}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":1,"harga":945000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":2,"harga":1830000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":3,"harga":2720000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":5,"harga":4500000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":10,"harga":8945000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":25,"harga":22237000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":50,"harga":44395000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":100,"harga":88712000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":250,"harga":221515000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":500,"harga":442820000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":1000,"harga":885600000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-22 02:47','emas-certicard','{"gram":0.5,"harga":516000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-22 02:47','emas-certicard','{"gram":1,"harga":932000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-22 02:47','emas-certicard','{"gram":2,"harga":1804000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-22 02:47','emas-certicard','{"gram":3,"harga":2681000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-22 02:47','emas-certicard','{"gram":5,"harga":4435000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-22 02:47','emas-certicard','{"gram":10,"harga":8815000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-22 02:47','emas-certicard','{"gram":25,"harga":21912000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-22 02:47','emas-certicard','{"gram":50,"harga":43745000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-22 02:47','emas-certicard','{"gram":100,"harga":87412000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-22 02:47','emas-certicard','{"gram":250,"harga":218265000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-22 02:47','emas-certicard','{"gram":500,"harga":436320000}');
INSERT INTO "harga_dasar_kami_jual" VALUES ('2021-06-22 02:47','emas-certicard','{"gram":1000,"harga":872600000}');
INSERT INTO "harga_kami_beli" VALUES ('2021-06-14 13:03','emas-certicard','{"harga":855000,"date":"2021-06-14 13:03"}');
INSERT INTO "harga_kami_beli" VALUES ('2021-06-22 02:49','emas-certicard','{"harga":829000,"date":"2021-06-22 02:49"}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":0.5,"harga":522500}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":1,"harga":945000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":2,"harga":1830000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":3,"harga":2720000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":5,"harga":4500000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":10,"harga":8945000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":25,"harga":22237000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":50,"harga":44395000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":100,"harga":88712000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":250,"harga":221515000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":500,"harga":442820000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-14 14:02','emas-certicard','{"gram":1000,"harga":885600000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-22 02:49','emas-certicard','{"gram":0.5,"harga":516000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-22 02:49','emas-certicard','{"gram":1,"harga":932000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-22 02:49','emas-certicard','{"gram":2,"harga":1804000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-22 02:49','emas-certicard','{"gram":3,"harga":2681000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-22 02:49','emas-certicard','{"gram":5,"harga":4435000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-22 02:49','emas-certicard','{"gram":10,"harga":8815000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-22 02:49','emas-certicard','{"gram":25,"harga":21912000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-22 02:49','emas-certicard','{"gram":50,"harga":43745000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-22 02:49','emas-certicard','{"gram":100,"harga":87412000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-22 02:49','emas-certicard','{"gram":250,"harga":218265000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-22 02:49','emas-certicard','{"gram":500,"harga":436320000}');
INSERT INTO "harga_kami_jual" VALUES ('2021-06-22 02:49','emas-certicard','{"gram":1000,"harga":872600000}');
COMMIT;
