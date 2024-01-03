CREATE TABLE ROLES(
    ROLE_ID INT NOT NULL AUTO_INCREMENT,
    ROLE_NAME VARCHAR(50) NOT NULL, 
    PRIMARY KEY (ROLE_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE USERS(
    -- USER_ID VARCHAR(10) NOT NULL AUTO_INCREMENT ,
    USER_NAME VARCHAR(50) NOT NULL,
    USER_PASSWORD VARCHAR(50),
    USER_EMAIL VARCHAR(50),
    USER_PHONE VARCHAR(50) NOT NULL,
    USER_ADDRESS VARCHAR(500),
    USER_ROLE int NOT NULL,
    USER_STATE VARCHAR(50) NOT NULL,
    USER_IMAGE VARCHAR(200),
    CREATE_DATE DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    LAST_LOGIN DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (USER_PHONE),
    FOREIGN KEY (USER_ROLE) REFERENCES ROLES(ROLE_ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE STORE(
    STORE_ID VARCHAR(10) NOT NULL,
    STORE_NAME VARCHAR(50) NOT NULL ,
    STORE_ADDRESS VARCHAR(50) NOT NULL ,
    STORE_PHONE VARCHAR(50) NOT NULL,
    STORE_EMAIL VARCHAR(50) NOT NULL,
    STORE_DESCRIPTION VARCHAR(50) NOT NULL ,
    STORE_IMAGE VARCHAR(100) NOT NULL,
    PRIMARY KEY (STORE_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE BRANDS(
    BRAND_ID VARCHAR(10) NOT NULL,
    BRAND_NAME VARCHAR(100) NOT NULL ,
    COUNTRY VARCHAR(50) NOT NULL ,
    BRAND_IMAGE VARCHAR(200) NOT NULL,
    NUMBER_PRODUCT INT NOT NULL,
    BRAND_DESCRIPTION VARCHAR(50) NOT NULL ,
    PRIMARY KEY (BRAND_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE CATEGORIES(
    CATEGORY_ID VARCHAR(10) NOT NULL,
    CATEGORY_NAME VARCHAR(50) NOT NULL ,
    CATEGORY_IMAGE VARCHAR(200) NOT NULL,
    NUMBER_PRODUCT INT NOT NULL,
    CATEGORY_DESCRIPTION VARCHAR(50) NOT NULL,
    primary key (CATEGORY_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE PRODUCTS(
    PRODUCT_ID VARCHAR(10) NOT NULL,
    PRODUCT_NAME VARCHAR(200) NOT NULL ,
    PRODUCT_DESCRIPTION VARCHAR(500) NOT NULL ,
    PRODUCT_IMAGE VARCHAR(200) NOT NULL,
    CATEGORY_ID VARCHAR(10) NOT NULL,
    BRAND_ID VARCHAR(10) NOT NULL,
    PRODUCT_SALEPRICE INT NOT NULL,
    -- tính bằng tháng
    warranty_period int NOT NULL,
    PRODUCT_STATUS VARCHAR(50) NOT NULL,
    IMAGE_SRC VARCHAR(500),
    PRIMARY KEY (PRODUCT_ID),
    FOREIGN KEY (CATEGORY_ID) REFERENCES CATEGORIES(CATEGORY_ID),
    FOREIGN KEY (BRAND_ID) REFERENCES BRANDS(BRAND_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;   

CREATE TABLE CODE_DISCOUNT(
    CODE_ID VARCHAR(10) NOT NULL,
    CODE_NAME VARCHAR(50) NOT NULL ,
    CODE_PERCENT INT NOT NULL,
    CODE_DESCRIPTION VARCHAR(50) NOT NULL ,
    PRIMARY KEY (CODE_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE PROMOTION(
    PROMOTION_ID VARCHAR(10) NOT NULL,
    PROMOTION_CODE VARCHAR(50) NOT NULL,
    PROMOTION_STARTDATE DATETIME NOT NULL,
    PROMOTION_ENDDATE DATETIME NOT NULL,
    PRODUCT_ID VARCHAR(10),
    PRIMARY KEY (PROMOTION_ID),
    FOREIGN KEY (PRODUCT_ID) REFERENCES PRODUCTS(PRODUCT_ID),
    FOREIGN KEY (PROMOTION_CODE) REFERENCES CODE_DISCOUNT(CODE_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE WAREHOUSE(
    STOCK_ID INT NOT NULL AUTO_INCREMENT,
    PRODUCT_ID VARCHAR(10) NOT NULL,
    PRODUCT_QUANTITY INT NOT NULL,
    PRODUCT_IMPORTPRICE INT NOT NULL,
    PRODUCT_STATUS VARCHAR(50) NOT NULL,
    MFG DATETIME NOT NULL,
    PRIMARY KEY (STOCK_ID),
    FOREIGN KEY (PRODUCT_ID) REFERENCES PRODUCTS(PRODUCT_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE ORDERS(
    ORDER_ID INT NOT NULL AUTO_INCREMENT,
    ORDER_DATE DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    ORDER_TOTAL INT NOT NULL,
    ORDER_STATUS int NOT NULL DEFAULT 0, 
    ORDER_SHIPPING int NOT NULL DEFAULT 0,
    USER_PHONE VARCHAR(50) NOT NULL,
    PRIMARY KEY (ORDER_ID),
    FOREIGN KEY (USER_PHONE) REFERENCES USERS(USER_PHONE)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE ORDER_DETAILS(
    ORDER_DETAIL_ID INT NOT NULL AUTO_INCREMENT,
    ORDER_DETAIL_QUANTITY INT NOT NULL,
    ORDER_DETAIL_PRICE INT NOT NULL,
    ORDER_ID INT NOT NULL,
    PRODUCT_ID VARCHAR(10) NOT NULL,
    PRIMARY KEY (ORDER_DETAIL_ID),
    FOREIGN KEY (ORDER_ID) REFERENCES ORDERS(ORDER_ID),
    FOREIGN KEY (PRODUCT_ID) REFERENCES PRODUCTS(PRODUCT_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE REVENUE(
    REVENUE_ID VARCHAR(10) NOT NULL,
    REVENUE_DATE DATETIME NOT NULL,
    REVENUE_TOTAL INT NOT NULL,
    PRIMARY KEY (REVENUE_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE FEEDBACK(
    FEEDBACK_ID int NOT NULL,
    FEEDBACK_CONTENT VARCHAR(500) NOT NULL ,
    FEEDBACK_DATE DATETIME NOT NULL,
    FEEDBACK_STATUS VARCHAR(50) NOT NULL,
    PRODUCT_ID VARCHAR(10) NOT NULL,
    NUMBER_STAR INT NOT NULL,
    USER_PHONE VARCHAR(50) NOT NULL,
    PRIMARY KEY (FEEDBACK_ID),
    FOREIGN KEY (USER_PHONE) REFERENCES USERS(USER_PHONE),
    FOREIGN KEY (PRODUCT_ID) REFERENCES PRODUCTS(PRODUCT_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE SITE_TRAFFIC(
    traffic_ID int AUTO_INCREMENT,
    traffic_DATE DATETIME NOT NULL,
    webTraffic INT NOT NULL,
    buyTraffic INT NOT NULL,
    traffic_TOTAL INT NOT NULL,
    PRIMARY KEY (traffic_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE WARRANTY(
    WARRANTY_ID VARCHAR(10) NOT NULL,
    CREATE_DATE DATETIME NOT NULL,
    END_DATE DATETIME NOT NULL,
    WARRANTY_STATUS VARCHAR(50) NOT NULL,
    ORDER_DETAIL_ID INT NOT NULL,
    PRIMARY KEY (WARRANTY_ID),
    FOREIGN KEY (ORDER_DETAIL_ID) REFERENCES ORDER_DETAILS(ORDER_DETAIL_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


------------- TRIGGER
-- Trigger to update NUMBER_PRODUCT in BRAND table
DELIMITER //

-- Trigger to update the number of products in the CATEGORIES table after INSERT
CREATE TRIGGER after_product_insert
AFTER INSERT ON PRODUCTS
FOR EACH ROW
BEGIN
    UPDATE CATEGORIES
    SET NUMBER_PRODUCT = NUMBER_PRODUCT + 1
    WHERE CATEGORY_ID = NEW.CATEGORY_ID;

    INSERT INTO WAREHOUSE (PRODUCT_ID, PRODUCT_QUANTITY, PRODUCT_IMPORTPRICE, PRODUCT_STATUS, MFG)
    VALUES (NEW.PRODUCT_ID, 0, 0, 'Out of Stock', NOW());
END;
//

-- Trigger to update the number of products in the CATEGORIES table after DELETE
CREATE TRIGGER after_product_delete
AFTER DELETE ON PRODUCTS
FOR EACH ROW
BEGIN
    UPDATE CATEGORIES
    SET NUMBER_PRODUCT = NUMBER_PRODUCT - 1
    WHERE CATEGORY_ID = OLD.CATEGORY_ID;
END;
//
-- Trigger to update the number of products in the BRANDS table after INSERT
CREATE TRIGGER after_product_insert_brand
AFTER INSERT ON PRODUCTS
FOR EACH ROW
BEGIN
    UPDATE BRANDS
    SET NUMBER_PRODUCT = NUMBER_PRODUCT + 1
    WHERE BRAND_ID = NEW.BRAND_ID;
END;
//

-- Trigger to update the number of products in the BRANDS table after DELETE
CREATE TRIGGER after_product_delete_brand
AFTER DELETE ON PRODUCTS
FOR EACH ROW
BEGIN
    UPDATE BRANDS
    SET NUMBER_PRODUCT = NUMBER_PRODUCT - 1
    WHERE BRAND_ID = OLD.BRAND_ID;
END;
//
DELIMITER ;


-- Insert data
-- ROLES
insert into ROLES(ROLE_NAME) values('Admin');
insert into ROLES(ROLE_NAME) values('User');

-- USERS
insert into USERS(USER_NAME, USER_PASSWORD, USER_EMAIL, USER_PHONE, USER_ROLE, USER_STATE, CREATE_DATE, LAST_LOGIN) 
    values('Lê Minh Chánh', null, null, '+84359297916', 1, 'active', '2020-11-30', '2020-11-30');

-- STORE
-- insert into STORE(STORE_ID, STORE_NAME, STORE_ADDRESS, STORE_PHONE, STORE_EMAIL, STORE_DESCRIPTION, STORE_IMAGE)  

-- BRANDS
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION) 
    values('SS','Samsung', 'Korea', 'https://images.samsung.com/is/image/samsung/assets/vn/about-us/brand/logo/pc/720_600_1.png?$720_N_PNG$', 0, 'Samsung');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION) 
    values('LG','LG', 'Korea', 'https://www.lg.com/content/dam/lge/global/our-brand/src/mocks/bs0002/brand-elements-logo-primary-d.svg', 0, 'LG');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION) 
    values('ELEC','Electrolux', 'Thailand', 'https://www.electrolux.vn/-/media/Images/Electrolux/Global/Brand-Logos/Electrolux-Logo-Black.png', 0, 'Electrolux');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION) 
    values('TOS','Toshiba', 'Japan', 'https://www.toshiba.com.vn/images/logo.png', 0, 'Toshiba');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION) 
    values('PANA','Panasonic', 'Japan', 'https://www.panasonic.com/content/dam/pim/vn/en/brand-logo/panasonic-logo.png', 0, 'Panasonic');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION) 
    values('HITA','Hitachi', 'Japan', 'https://www.hitachi.com.vn/images/logo.png', 0, 'Hitachi');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION) 
    values('AQUA','Aqua', 'Vietnam', 'https://www.aqua.com.vn/wp-content/uploads/2019/10/logo-aqua.png', 0, 'Aqua');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION) 
    values('KANG','Kangaroo', 'Vietnam', 'https://kangaroo.vn/wp-content/uploads/2019/10/logo-kangaroo.png', 0, 'Kangaroo');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION)
    values('DAIK','Daikio', 'Japan', 'https://www.daikin.com.vn/wp-content/uploads/2019/10/logo-daikin.png', 0, 'Daikio');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION)
    values('GA', 'Galanz', 'China', 'https://www.galanz.com.vn/wp-content/uploads/2019/10/logo-galanz.png', 0, 'Galanz');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION)
    values('BO', 'Bosch', 'Germany', 'https://www.bosch-home.com.vn/~/media/Images/Bosch/Global/Brand%20Logos/Bosch-Logo-Black.png', 0, 'Bosch');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION)
    values('BLS', 'Bluestone', 'Vietnam', 'https://bluestone.vn/wp-content/uploads/2019/10/logo-bluestone.png', 0, 'Bluestone');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION)
    values('SH', 'Sunhouse', 'Vietnam', 'https://sunhouse.com.vn/wp-content/uploads/2019/10/logo-sunhouse.png', 0, 'Sunhouse');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION)
    values('SA', 'Sharp', 'Japan', 'https://www.sharp.com.vn/wp-content/uploads/2019/10/logo-sharp.png', 0, 'Sharp');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION)
    values('SONY', 'Sony', 'Japan', 'https://www.sony.com.vn/image/sonyvietnam/brand_logo.png', 0, 'Sony');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION)
    values('DE', 'Delonghi', 'Italy', 'https://www.delonghi.com/Global/Brand%20Logos/DeLonghi-Logo-Black.png', 0, 'Delonghi');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION)
    values('PU', 'Puwa', 'Vietnam', 'https://puwa.vn/wp-content/uploads/2019/10/logo-puwa.png', 0, 'Puwa');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION)
    values('AVA', 'AVA', 'Vietnam', 'https://ava.vn/wp-content/uploads/2019/10/logo-ava.png', 0, 'AVA');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION)
    values('PHI', 'Philips', 'Netherlands', 'https://www.philips.com.vn/c-dam/b2c/category-pages/brand-page/brand-logo.png', 0, 'Philips');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION)
    values('CEMU', 'Ceramic Mutosi', 'Vietnam', 'https://ceramicmutosi.vn/wp-content/uploads/2019/10/logo-ceramic-mutosi.png', 0, 'Ceramic Mutosi');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION)
    values('OP', 'OPPO', 'China', 'https://www.oppo.com/content/dam/oppo/common/mkt/vn/logo.png', 0, 'OPPO');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION)
    values('VV', 'Vivo', 'China', 'https://www.vivo.com.vn/wp-content/uploads/2019/10/logo-vivo.png', 0, 'Vivo');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION)
    values('XI', 'Xiaomi', 'China', 'https://www.xiaomi.com/vn/static/images/logo.png', 0, 'Xiaomi');
insert into BRANDS(BRAND_ID ,BRAND_NAME, COUNTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION)
    values('HO', 'Hommy' , 'Vietnam', 'https://hommy.vn/wp-content/uploads/2019/10/logo-hommy.png', 0, 'Hommy');

-- CATEGORIES
INSERT INTO CATEGORIES (CATEGORY_ID ,CATEGORY_NAME, CATEGORY_IMAGE, NUMBER_PRODUCT, CATEGORY_DESCRIPTION) 
    VALUES ('TV', 'Tivi', 'https://cdn.tgdd.vn/Products/Images/1942/235794/led-4k-samsung-ua65au8100-2.jpg', 0, 'Television');
INSERT INTO CATEGORIES (CATEGORY_ID ,CATEGORY_NAME, CATEGORY_IMAGE, NUMBER_PRODUCT, CATEGORY_DESCRIPTION) 
    VALUES ('L','Loa, dàn karaoke', 'https://cdn.tgdd.vn/Products/Images/2162/304779/304779-600x600.jpg', 0, 'Audio and Karaoke System');
INSERT INTO CATEGORIES (CATEGORY_ID ,CATEGORY_NAME, CATEGORY_IMAGE, NUMBER_PRODUCT, CATEGORY_DESCRIPTION) 
    VALUES ('MG','Máy giặt', 'https://cdn.tgdd.vn/Products/Images/1944/304621/may-giat-say-lg-inverter-21-kg-f2721hvrb-110423-020146-600x600.jpg', 0, 'Washing Machine');
INSERT INTO CATEGORIES (CATEGORY_ID ,CATEGORY_NAME, CATEGORY_IMAGE, NUMBER_PRODUCT, CATEGORY_DESCRIPTION) 
    VALUES ('MS','Máy sấy', 'https://cdn.tgdd.vn/Products/Images/2202/309558/may-say-bom-nhiet-samsung-9-kg-dv90bb9440gh-sv-230623-122345-600x600.jpg', 0, 'Dryer');
INSERT INTO CATEGORIES (CATEGORY_ID ,CATEGORY_NAME, CATEGORY_IMAGE, NUMBER_PRODUCT, CATEGORY_DESCRIPTION) 
    VALUES ('ML','Máy lạnh', 'https://cdn.tgdd.vn/Products/Images/2002/303862/Slider/may-lanh-aqua-inverter-1-hp-aqa-ruv10rb638174355437648592.jpg', 0, 'Air Conditioner');
INSERT INTO CATEGORIES (CATEGORY_ID ,CATEGORY_NAME, CATEGORY_IMAGE, NUMBER_PRODUCT, CATEGORY_DESCRIPTION) 
    VALUES ('TL','Tủ lạnh', 'https://cdn.tgdd.vn/Products/Images/1943/220325/Slider/02-1020x571.jpg', 0, 'Refrigerator');
INSERT INTO CATEGORIES (CATEGORY_ID ,CATEGORY_NAME, CATEGORY_IMAGE, NUMBER_PRODUCT, CATEGORY_DESCRIPTION) 
    VALUES ('MNN','Máy nước nóng', 'https://cdn.tgdd.vn/Products/Images/1962/227136/Slider/rossi-elegenz-20l-ngang-rez20sl-180821-0947041.jpg', 0, 'Water Heater');
INSERT INTO CATEGORIES (CATEGORY_ID ,CATEGORY_NAME, CATEGORY_IMAGE, NUMBER_PRODUCT, CATEGORY_DESCRIPTION) 
    VALUES ('MX','Máy xay, máy ép', 'https://cdn.tgdd.vn/Products/Images/1985/278366/tefal-blendforce-piano-bl47yb66-1.jpg', 0, 'Grinder and Press');
INSERT INTO CATEGORIES (CATEGORY_ID ,CATEGORY_NAME, CATEGORY_IMAGE, NUMBER_PRODUCT, CATEGORY_DESCRIPTION) 
    VALUES ('MLN','Máy lọc nước', 'https://cdn.tgdd.vn/Products/Images/3385/296831/may-loc-nuoc-ro-karofi-kaq-x16-10-loi-1.jpg', 0, 'Water Filter');
INSERT INTO CATEGORIES (CATEGORY_ID ,CATEGORY_NAME, CATEGORY_IMAGE, NUMBER_PRODUCT, CATEGORY_DESCRIPTION) 
    VALUES ('MHB','Máy hút bụi', 'https://cdn.tgdd.vn/Products/Images/1990/310455/may-hut-bui-lau-nha-dreame-h12-dual-1.jpg', 0, 'Vacuum Cleaner');
INSERT INTO CATEGORIES (CATEGORY_ID ,CATEGORY_NAME, CATEGORY_IMAGE, NUMBER_PRODUCT, CATEGORY_DESCRIPTION) 
    VALUES ('MRC','Máy rửa chén', 'https://cdn.tgdd.vn/Products/Images/5475/299889/may-rua-chen-bosch-sms46gi01p-tgb-1-1.jpg', 0, 'Dishwasher');
INSERT INTO CATEGORIES (CATEGORY_ID ,CATEGORY_NAME, CATEGORY_IMAGE, NUMBER_PRODUCT, CATEGORY_DESCRIPTION) 
    VALUES ('LN','Lò nướng', 'https://cdn.tgdd.vn/Products/Images/2063/291407/lo-nuong-electrolux-eot4022xfg-40-lit-2.jpg', 0, 'Oven');
INSERT INTO CATEGORIES (CATEGORY_ID ,CATEGORY_NAME, CATEGORY_IMAGE, NUMBER_PRODUCT, CATEGORY_DESCRIPTION) 
    VALUES ('TBNB','Thiết bị nhà bếp', 'https://cdn.tgdd.vn/Products/Images/12318/234363/electrolux-e2ts1-100w-090223-111132-600x600.jpg', 0, 'Kitchen Appliances');
INSERT INTO CATEGORIES (CATEGORY_ID ,CATEGORY_NAME, CATEGORY_IMAGE, NUMBER_PRODUCT, CATEGORY_DESCRIPTION) 
    VALUES ('Q','Quạt', 'https://cdn.tgdd.vn/Products/Images/7498/236964/daikiosan-dka-04000g-040923-025222-600x600.jpg', 0, 'Fan');
INSERT INTO CATEGORIES (CATEGORY_ID ,CATEGORY_NAME, CATEGORY_IMAGE, NUMBER_PRODUCT, CATEGORY_DESCRIPTION) 
    VALUES ('MLKK','Máy lọc không khí', 'https://cdn.tgdd.vn/Products/Images/5473/243091/243091-600x600.jpg', 0, 'Air Purifier');
INSERT INTO CATEGORIES (CATEGORY_ID ,CATEGORY_NAME, CATEGORY_IMAGE, NUMBER_PRODUCT, CATEGORY_DESCRIPTION) 
    VALUES ('B','Bếp', 'https://cdn.tgdd.vn/Products/Images/1982/279966/279966-600x600.jpg', 0, 'Stove');
INSERT INTO CATEGORIES (CATEGORY_ID ,CATEGORY_NAME, CATEGORY_IMAGE, NUMBER_PRODUCT, CATEGORY_DESCRIPTION) 
    VALUES ('TBSA','Thiết bị sưởi ấm', 'https://cdn.tgdd.vn/Products/Images/2428/252133/gom-kangaroo-kgfh05-1.-600x600.jpg', 0, 'Thiết bị sưởi ấm');
INSERT INTO CATEGORIES (CATEGORY_ID ,CATEGORY_NAME, CATEGORY_IMAGE, NUMBER_PRODUCT, CATEGORY_DESCRIPTION) 
    VALUES ('N','Nồi', 'https://cdn.tgdd.vn/Products/Images/1922/147243/delites-ncr1502-281022-033255-600x600.jpg', 0, 'Pot');
INSERT INTO CATEGORIES (CATEGORY_ID ,CATEGORY_NAME, CATEGORY_IMAGE, NUMBER_PRODUCT, CATEGORY_DESCRIPTION) 
    VALUES ('CNNL','Cây nước nóng lạnh', 'https://cdn.tgdd.vn/Products/Images/2222/210643/210643-1--600x600.jpg', 0, 'Hot and Cold Water Dispenser');
INSERT INTO CATEGORIES (CATEGORY_ID ,CATEGORY_NAME, CATEGORY_IMAGE, NUMBER_PRODUCT, CATEGORY_DESCRIPTION) 
    VALUES ('DT','Điện thoại', 'https://cdn.tgdd.vn/Products/Images/42/235838/Galaxy-S22-Ultra-Burgundy-600x600.jpg', 0, 'Phone');

-- PRODUCTS
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC)     VALUES ('TV1','Smart Tivi Samsung 4K Crystal UHD 65 inch UA65AU8100','Smart Tivi Samsung 4K Crystal UHD 65 inch UA65AU8100',
	'https://cdn.tgdd.vn/Products/Images/1942/235794/led-4k-samsung-ua65au8100-2.jpg','TV','SS', 12900000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/1942/235794/Slider/led-4k-samsung-ua65au8100-280721-0455350.png ,https://cdn.tgdd.vn/Products/Images/1942/235794/Slider/led-4k-samsung-ua65au8100-280721-0456170.png ,https://cdn.tgdd.vn/Products/Images/1942/235794/Slider/vi-vn-led-4k-samsung-ua65au8100-011.jpg ,https://cdn.tgdd.vn/Products/Images/1942/235794/Slider/thumb2-1020x570.jpeg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('TV2','Smart Tivi QLED 4K 50 inch Samsung QA50Q65A','Smart Tivi QLED 4K 50 inch Samsung QA50Q65A',
	'https://cdn.tgdd.vn/Products/Images/1942/235641/qled-4k-samsung-qa50q65a-2.jpg','TV','SS', 11690000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/1942/235641/qled-4k-samsung-qa50q65a-3.jpg ,https://dienmayabc.com/media/product/4094_tivi_samsung_qa50q65a_20_org.png ,https://dienmayabc.com/media/product/4094_tivi_samsung_qa50q65a_21_org.jpg ,https://dienmayabc.com/media/product/4094_tivi_samsung_qa50q65a_23_org.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('TV3','Android Tivi AQUA 4K 65 inch AQT65D67UG','Android Tivi AQUA 4K 65 inch AQT65D67UG',
	'https://cdn.tgdd.vn/Products/Images/1942/313848/android-tivi-aqua-4k-65-inch-aqt65d67ug-00.jpg','TV','AQUA', 11990000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/1942/313848/android-tivi-aqua-4k-65-inch-aqt65d67ug-02.jpg ,https://cdn.tgdd.vn/Products/Images/1942/313848/android-tivi-aqua-4k-65-inch-aqt65d67ug-03.jpg , https://cdn.tgdd.vn/Products/Images/1942/313848/android-tivi-aqua-4k-65-inch-aqt65d67ug-04.jpg , https://cdn.tgdd.vn/Products/Images/1942/313848/android-tivi-aqua-4k-65-inch-aqt65d67ug-05.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC)
    VALUES ('TV4','Smart Tivi OLED LG 4K 48 inch 48A3PSA','Smart Tivi OLED LG 4K 48 inch 48A3PSA',
	'https://cdn.tgdd.vn/Products/Images/1942/306571/smart-tivi-oled-lg-4k-48-inch-48a3psa-1.jpg','TV','LG', 31900000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/1942/306571/smart-tivi-oled-lg-4k-48-inch-48a3psa-2.jpg ,https://cdn.tgdd.vn/Products/Images/1942/306571/smart-tivi-oled-lg-4k-48-inch-48a3psa-4.jpg ,https://cdn.tgdd.vn/Products/Images/1942/306571/smart-tivi-oled-lg-4k-48-inch-48a3psa-6.jpg ,https://cdn.tgdd.vn/Products/Images/1942/306571/smart-tivi-oled-lg-4k-48-inch-48a3psa-7.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('TV5','Smart Tivi OLED LG 4K 48 inch 48C2PSA','Smart Tivi OLED LG 4K 48 inch 48C2PSA',
	'https://cdn.tgdd.vn/Products/Images/1942/278539/smart-oled-lg-4k-48-inch-48c2psa-1-3.jpg','TV','LG', 21890000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/1942/278539/smart-oled-lg-4k-48-inch-48c2psa-3-3.jpg ,https://cdn.tgdd.vn/Products/Images/1942/278539/smart-oled-lg-4k-48-inch-48c2psa-5-3.jpg ,https://cdn.tgdd.vn/Products/Images/1942/278539/smart-oled-lg-4k-48-inch-48c2psa-10-1.jpg ,https://cdn.tgdd.vn/Products/Images/1942/278539/smart-oled-lg-4k-48-inch-48c2psa-12.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS) 
    VALUES ('TV6','Smart Tivi QLED 4K 75 inch Samsung QA75Q80C','Smart Tivi QLED 4K 75 inch Samsung QA75Q80C','https://cdn.tgdd.vn/Products/Images/1942/303214/smart-tivi-qled-4k-75-inch-samsung-qa75q80c-01.jpg','TV','SS', 12000000 , 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS) 
    VALUES ('TV7','Smart Tivi Samsung 4K Crystal UHD 85 inch UA85BU8000','Smart Tivi Samsung 4K Crystal UHD 85 inch UA85BU8000','https://cdn.tgdd.vn/Products/Images/1942/273377/gu65bu8079uxzg_002_r-perspective_black.jpg','TV','SS', 1200000 , 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS) 
    VALUES ('TV8','Smart Tivi Neo QLED 4K 65 inch Samsung QA65QN90C','Smart Tivi Neo QLED 4K 65 inch Samsung QA65QN90C','https://cdn.tgdd.vn/Products/Images/1942/303172/smart-tivi-neo-qled-4k-65-inch-samsung-qa65qn90c-1.jpg','TV','SS', 1200000 , 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS) 
    VALUES ('TV9','Smart Tivi QLED 4K 85 inch Samsung QA85Q80B','Smart Tivi QLED 4K 85 inch Samsung QA85Q80B','https://cdn.tgdd.vn/Products/Images/1942/273410/smart-tivi-qled-4k-85-inch-samsung-qa85q80b-2.jpg','TV','SS', 1200000 , 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS) 
    VALUES ('TV10','Smart Tivi Neo QLED 4K 98 inch Samsung QA98QN90A','Smart Tivi Neo QLED 4K 98 inch Samsung QA98QN90A','https://cdn.tgdd.vn/Products/Images/1942/250263/3-org-org.jpg','TV','SS', 1200000 , 12, 'active');  
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS) 
    VALUES ('TV11','Smart Tivi OLED Samsung 4K 77 inch QA77S90CA','Smart Tivi OLED Samsung 4K 77 inch QA77S90CA','https://cdn.tgdd.vn/Products/Images/1942/304397/smart-tivi-oled-samsung-4k-77-inch-qa77s90ca-1.jpg','TV','SS', 1200000 , 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS) 
    VALUES ('TV12','Smart Tivi Neo QLED 8K 85 inch Samsung QA85QN900C','Smart Tivi Neo QLED 8K 85 inch Samsung QA85QN900C','https://cdn.tgdd.vn/Products/Images/1942/303159/smart-tivi-neo-qled-8k-85-inch-samsung-qa85qn900c-1.jpg','TV','SS', 1200000 , 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS) 
    VALUES ('TV13','Smart Tivi QLED 4K 98 inch Samsung QA98Q80C','Smart Tivi QLED 4K 98 inch Samsung QA98Q80C','https://cdn.tgdd.vn/Products/Images/1942/305837/smart-tivi-qled-4k-98-inch-samsung-qa98q80c-1.jpg','TV','SS', 1200000 , 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS) 
    VALUES ('TV14','Smart Tivi Samsung 4K Crystal UHD 50 inch UA50AU7200','Smart Tivi Samsung 4K Crystal UHD 50 inch UA50AU7200','https://cdn.tgdd.vn/Products/Images/1942/235800/led-4k-samsung-ua50au7200-1.jpg','TV','SS', 1200000 , 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS) 
    VALUES ('TV15','Google Tivi Sony 4K 55 inch KD-55X80K','Google Tivi Sony 4K 55 inch KD-55X80K','https://cdn.tgdd.vn/Products/Images/1942/274761/android-sony-4k-55-inch-kd-55x80k-1.jpg','TV','SS', 1200000 , 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS) 
    VALUES ('TV16','Google Tivi Sony 4K 43 inch KD-43X75K','Google Tivi Sony 4K 43 inch KD-43X75K','https://cdn.tgdd.vn/Products/Images/1942/275517/google-sony-4k-43-inch-kd-43x75k-1.jpg','TV','SS', 1200000 , 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('L1','Bộ loa thanh Samsung HW-Q700B 320W','Bộ loa thanh Samsung HW-Q700B 320W',
	'https://cdn.tgdd.vn/Products/Images/2162/273906/1-3.png','L','SS', 13990000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/2162/273906/2-3.png ,https://cdn.tgdd.vn/Products/Images/2162/273906/3-3.png ,https://cdn.tgdd.vn/Products/Images/2162/273906/4-3.png ,https://cdn.tgdd.vn/Products/Images/2162/273906/Slider/thanh-samsung-hw-q700b638295983987442558.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('L2','Bộ loa thanh LG S75Q 380W','Bộ loa thanh LG S75Q 380W',
	'https://cdn.tgdd.vn/Products/Images/2162/284108/loa-thanh-soundbar-lg-s75q-001.jpg','L','LG', 4990000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/2162/284108/thanh-soundbar-lg-s75q-01-1.jpg ,https://cdn.tgdd.vn/Products/Images/2162/284108/thanh-soundbar-lg-s75q-02-1.jpg ,https://cdn.tgdd.vn/Products/Images/2162/284108/thanh-soundbar-lg-s75q-03-1.jpg , https://cdn.tgdd.vn/Products/Images/2162/284108/thanh-soundbar-lg-s75q-04-1.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('L3','Bộ loa thanh LG SN4 300W','Bộ loa thanh LG SN4 300W',
	'https://cdn.tgdd.vn/Products/Images/2162/309068/loa-thanh-lg-sn4-hang-1.jpg','L','LG', 5490000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/2162/309068/loa-thanh-lg-sn4-hang-2.jpg ,https://cdn.tgdd.vn/Products/Images/2162/309068/loa-thanh-lg-sn4-hang-3.jpg , https://cdn.tgdd.vn/Products/Images/2162/309068/loa-thanh-lg-sn4-hang-4.jpg , https://cdn.tgdd.vn/Products/Images/2162/309068/loa-thanh-lg-sn4-hang-7.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('L4','Loa tháp Samsung MX-T70/XV 1500W','Loa tháp Samsung MX-T70/XV 1500W',
	'https://cdn.tgdd.vn/Products/Images/2162/220699/samsung-mx-t70-xv-1-1-org.jpg','L','SS', 10990000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/2162/220699/samsung-mx-t70-xv-1-org.jpg ,https://cdn.tgdd.vn/Products/Images/2162/220699/samsung-mx-t70-xv-2-org.jpg ,https://cdn.tgdd.vn/Products/Images/2162/220699/samsung-mx-t70-xv-2-1-org.jpg ,https://cdn.tgdd.vn/Products/Images/2162/220699/samsung-mx-t70-xv-3-org.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('L5','Bộ loa thanh Samsung HW-B650 430W','Bộ loa thanh Samsung HW-B650 430W',
	'https://cdn.tgdd.vn/Products/Images/2162/273909/thanh-samsung-hw-b650-1-1.jpg','L','SS', 8490000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/2162/273909/thanh-samsung-hw-b650-2-1.jpg ,https://cdn.tgdd.vn/Products/Images/2162/273909/thanh-samsung-hw-b650-3-1.jpg ,https://cdn.tgdd.vn/Products/Images/2162/273909/thanh-samsung-hw-b650-5-1.jpg , https://cdn.tgdd.vn/Products/Images/1944/278958/tu-cham-soc-quan-ao-thong-minh-samsung-df10a9500cg-sv-10.jpg'); 
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('MG1','Tủ chăm sóc quần áo thông minh Samsung Bespoke AirDresser 5 móc DF10A9500CG/SV','Tủ chăm sóc quần áo thông minh Samsung Bespoke AirDresser 5 móc DF10A9500CG/SV',
	'https://cdn.tgdd.vn/Products/Images/1944/278958/tu-cham-soc-quan-ao-thong-minh-samsung-df10a9500cg-sv-7.jpg','MG','SS', 48500000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/1944/278958/tu-cham-soc-quan-ao-thong-minh-samsung-df10a9500cg-sv-2.jpg ,https://cdn.tgdd.vn/Products/Images/1944/278958/tu-cham-soc-quan-ao-thong-minh-samsung-df10a9500cg-sv-5.jpg ,https://cdn.tgdd.vn/Products/Images/1944/278958/tu-cham-soc-quan-ao-thong-minh-samsung-df10a9500cg-sv-8.jpg ,https://cdn.tgdd.vn/Products/Images/1942/235794/Slider/thumb2-1020x570.jpeg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('MG2','Máy giặt Samsung Bespoke AI Inverter 24 kg WF24B9600KV/SV','Máy giặt Samsung Bespoke AI Inverter 24 kg WF24B9600KV/SV',
	'https://cdn.tgdd.vn/Products/Images/1944/307131/may-giat-samsung-inverter-24-kg-wf24b9600kv-sv-1-3.jpg','MG','SS', 33990000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/1944/307131/may-giat-samsung-inverter-24-kg-wf24b9600kv-sv-2-3.jpg ,https://cdn.tgdd.vn/Products/Images/1944/307131/may-giat-samsung-inverter-24-kg-wf24b9600kv-sv-3-3.jpg ,https://cdn.tgdd.vn/Products/Images/1944/307131/may-giat-samsung-inverter-24-kg-wf24b9600kv-sv-5-1.jpg ,https://cdn.tgdd.vn/Products/Images/1944/307131/may-giat-samsung-inverter-24-kg-wf24b9600kv-sv-6-1.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('MG3','Máy giặt Panasonic Inverter 11.5 Kg NA-FD11AR1BV','Máy giặt Panasonic Inverter 11.5 Kg NA-FD11AR1BV',
	'https://cdn.tgdd.vn/Products/Images/1944/216016/panasonic-na-fd11ar1bv-1-3-org.jpg','MG','PANA', 11990000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/1944/216016/panasonic-na-fd11ar1bv-2-2-org.jpg ,https://cdn.tgdd.vn/Products/Images/1944/216016/panasonic-na-fd11ar1bv-3-3-org.jpg , https://cdn.tgdd.vn/Products/Images/1944/216016/panasonic-na-fd11ar1bv-4-1-org.jpg , https://cdn.tgdd.vn/Products/Images/1944/216016/panasonic-na-fd11ar1bv-5-1-org.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('MG4','Máy giặt Aqua Inverter 10.5 kg AQW-DR105JT BK','Máy giặt Aqua Inverter 10.5 kg AQW-DR105JT BK',
	'https://cdn.tgdd.vn/Products/Images/1944/307239/may-giat-aqua-inverter-105-kg-aqw-dr105jt-bk-01.jpg','MG','AQUA', 7790000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/1944/307239/may-giat-aqua-inverter-105-kg-aqw-dr105jt-bk-02.jpg ,https://cdn.tgdd.vn/Products/Images/1944/307239/may-giat-aqua-inverter-105-kg-aqw-dr105jt-bk-03.jpg ,https://cdn.tgdd.vn/Products/Images/1944/307239/may-giat-aqua-inverter-105-kg-aqw-dr105jt-bk-04.jpg , https://cdn.tgdd.vn/Products/Images/1944/307239/may-giat-aqua-inverter-105-kg-aqw-dr105jt-bk-08.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('MS1','Máy sấy bơm nhiệt Samsung Bespoke AI 9 kg DV90BB9440GH/SV','Máy sấy bơm nhiệt Samsung Bespoke AI 9 kg DV90BB9440GH/SV',
	'https://cdn.tgdd.vn/Products/Images/2202/309558/may-say-bom-nhiet-samsung-9-kg-dv90bb9440gh-sv-1.jpg','MS','SS', 22990000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/2202/309558/may-say-bom-nhiet-samsung-9-kg-dv90bb9440gh-sv-2.jpg ,https://cdn.tgdd.vn/Products/Images/2202/309558/may-say-bom-nhiet-samsung-9-kg-dv90bb9440gh-sv-3.jpg ,https://cdn.tgdd.vn/Products/Images/2202/309558/may-say-bom-nhiet-samsung-9-kg-dv90bb9440gh-sv-4.jpg ,https://cdn.tgdd.vn/Products/Images/2202/309558/may-say-bom-nhiet-samsung-9-kg-dv90bb9440gh-sv-6.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('MS2','Máy sấy ngưng tụ Electrolux UltimateCare 8 kg EDC804P5WB','Máy sấy ngưng tụ Electrolux UltimateCare 8 kg EDC804P5WB',
	'https://cdn.tgdd.vn/Products/Images/2202/284032/may-say-ngung-tu-electrolux-8-kg-edc804p5wb.jpg','MS','SS', 19990000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/2202/284032/may-say-ngung-tu-electrolux-8-kg-edc804p5wb-2.jpg ,https://cdn.tgdd.vn/Products/Images/2202/284032/may-say-ngung-tu-electrolux-8-kg-edc804p5wb-3.jpg , https://cdn.tgdd.vn/Products/Images/2202/284032/may-say-ngung-tu-electrolux-8-kg-edc804p5wb-4.jpg , https://cdn.tgdd.vn/Products/Images/2202/284032/may-say-ngung-tu-electrolux-8-kg-edc804p5wb-5.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC)
	VALUES ('MS3','Máy sấy bơm nhiệt Samsung 9 Kg DV90T7240BB/SV','Máy sấy bơm nhiệt Samsung 9 Kg DV90T7240BB/SV',
	'https://cdn.tgdd.vn/Products/Images/2202/236238/may-say-samsung-dv90t7240bb-sv-1-org.jpg','MS','SS', 20390000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/2202/236238/may-say-samsung-dv90t7240bb-sv-2-org.jpg ,https://cdn.tgdd.vn/Products/Images/2202/236238/may-say-samsung-dv90t7240bb-sv-3-org.jpg ,https://cdn.tgdd.vn/Products/Images/2202/236238/may-say-samsung-dv90t7240bb-sv-4-org.jpg ,https://cdn.tgdd.vn/Products/Images/2202/236238/may-say-samsung-dv90t7240bb-sv-5-org.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC)
	VALUES ('ML1','Máy lạnh Toshiba Inverter 1.5 HP RAS-H13Z1KCVG-V','Máy lạnh Toshiba Inverter 1.5 HP RAS-H13Z1KCVG-V',
	'https://cdn.tgdd.vn/Products/Images/2002/303107/may-lanh-toshiba-inverter-15-hp-ras-h13z1kcvg-v2.jpg','ML','TOS', 13290000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/2002/303107/may-lanh-toshiba-inverter-15-hp-ras-h13z1kcvg-v3.jpg ,https://cdn.tgdd.vn/Products/Images/2002/303107/may-lanh-toshiba-inverter-15-hp-ras-h13z1kcvg-v4.jpg ,https://cdn.tgdd.vn/Products/Images/2002/303107/may-lanh-toshiba-inverter-15-hp-ras-h13z1kcvg-v5.jpg , https://cdn.tgdd.vn/Products/Images/2002/303107/may-lanh-toshiba-inverter-15-hp-ras-h13z1kcvg-v7.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC)
	VALUES ('ML2','Máy lạnh Panasonic Inverter 1.5 HP CU/CS-PU12ZKH-8M','Máy lạnh Panasonic Inverter 1.5 HP CU/CS-PU12ZKH-8M',
	'https://cdn.tgdd.vn/Products/Images/2002/303872/may-lanh-panasonic-inverter-15-hp-cu-cs-pu12zkh-81-1.jpg','ML','PANA', 13890000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/2002/303872/may-lanh-panasonic-inverter-15-hp-cu-cs-pu12zkh-82-1.jpg ,https://cdn.tgdd.vn/Products/Images/2002/303872/may-lanh-panasonic-inverter-15-hp-cu-cs-pu12zkh-83-1.jpg , https://cdn.tgdd.vn/Products/Images/2002/303872/may-lanh-panasonic-inverter-15-hp-cu-cs-pu12zkh-84-1.jpg ,https://cdn.tgdd.vn/Products/Images/2002/303872/may-lanh-panasonic-inverter-15-hp-cu-cs-pu12zkh-89.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC)
	VALUES ('ML3','Máy lạnh Aqua Inverter 1.5 HP AQA-RV13QA','Máy lạnh Aqua Inverter 1.5 HP AQA-RV13QA',
	'https://cdn.tgdd.vn/Products/Images/2002/303859/may-lanh-aqua-inverter-15-hp-aqa-rv13qa1-1.jpg','ML','AQUA', 10390000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/2002/303859/may-lanh-aqua-inverter-15-hp-aqa-rv13qa2-1.jpg ,https://cdn.tgdd.vn/Products/Images/2002/303859/may-lanh-aqua-inverter-15-hp-aqa-rv13qa3-1.jpg ,https://cdn.tgdd.vn/Products/Images/2002/303859/may-lanh-aqua-inverter-15-hp-aqa-rv13qa7.jpg ,https://cdn.tgdd.vn/Products/Images/2002/303859/may-lanh-aqua-inverter-15-hp-aqa-rv13qa8.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC)
	VALUES ('TL1','Tủ lạnh Panasonic Inverter 417 lít NR-BX471GPKV','Tủ lạnh Panasonic Inverter 417 lít NR-BX471GPKV',
	'https://cdn.tgdd.vn/Products/Images/1943/235431/panasonic-nr-bx471gpkv-2-org.jpg','TL','PANA', 20490000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/1943/235431/panasonic-nr-bx471gpkv-4-org.jpg ,https://cdn.tgdd.vn/Products/Images/1943/235431/panasonic-nr-bx471gpkv-5-org.jpg ,https://cdn.tgdd.vn/Products/Images/1943/235431/panasonic-nr-bx471gpkv-11-org.jpg , https://cdn.tgdd.vn/Products/Images/1943/235431/panasonic-nr-bx471gpkv-12-org.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC)
	VALUES ('TL2','Tủ lạnh Toshiba Inverter 511 lít Multi Door GR-RF610WE-PGV(22)-XK','Tủ lạnh Toshiba Inverter 511 lít Multi Door GR-RF610WE-PGV(22)-XK',
	'https://cdn.tgdd.vn/Products/Images/1943/228369/toshiba-gr-rf610we-pgv-22-xk-4-6.jpg','TL','TOS', 20490000 , 12, 'active',
	'https://cdn.tgdd.vn/Products/Images/1943/228369/toshiba-gr-rf610we-pgv-22-xk-5-6.jpg ,https://cdn.tgdd.vn/Products/Images/1943/228369/toshiba-gr-rf610we-pgv-22-xk-6-6.jpg ,https://cdn.tgdd.vn/Products/Images/1943/228369/toshiba-gr-rf610we-pgv-22-xk-7-6.jpg , https://cdn.tgdd.vn/Products/Images/1943/228369/toshiba-gr-rf610we-pgv-22-xk-8-5.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC)
	VALUES ('TL3','Tủ lạnh Panasonic Inverter 550 lít Multi Door NR-DZ601VGKV','Tủ lạnh Panasonic Inverter 550 lít Multi Door NR-DZ601VGKV',
	'https://cdn.tgdd.vn/Products/Images/1943/240703/panasonic-inverter-550-lit-nr-dz601vgkv-2-org.jpg','TL','PANA', 32990000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/1943/240703/panasonic-inverter-550-lit-nr-dz601vgkv-3-org.jpg ,https://cdn.tgdd.vn/Products/Images/1943/240703/panasonic-inverter-550-lit-nr-dz601vgkv-4-org.jpg ,https://cdn.tgdd.vn/Products/Images/1943/240703/panasonic-inverter-550-lit-nr-dz601vgkv-5-org.jpg , https://cdn.tgdd.vn/Products/Images/1943/240703/panasonic-inverter-550-lit-nr-dz601vgkv-7-org.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC)
	VALUES ('TL4','Tủ lạnh LG Inverter 519 lít Side By Side GR-B256JDS','Tủ lạnh LG Inverter 519 lít Side By Side GR-B256JDS',
	'https://cdn.tgdd.vn/Products/Images/1943/307871/lg-gr-b256jds1-1.jpg','TL','LG', 13990000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/1943/307871/lg-gr-b256jds2-1.jpg ,https://cdn.tgdd.vn/Products/Images/1943/307871/lg-gr-b256jds4-1.jpg ,https://cdn.tgdd.vn/Products/Images/1943/307871/lg-gr-b256jds5-1.jpg ,https://cdn.tgdd.vn/Products/Images/1943/307871/lg-gr-b256jds6-1.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC)
	VALUES ('TL5','Tủ lạnh Samsung Inverter 655 lít Side By Side RS62R5001B4/SV','Tủ lạnh Samsung Inverter 655 lít Side By Side RS62R5001B4/SV',
	'https://cdn.tgdd.vn/Products/Images/1943/201134/tu-lanh-samsung-rs62r5001b4-sv-1-org.jpg','TL','SS', 17090000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/1943/201134/tu-lanh-samsung-rs62r5001b4-sv-2-org.jpg ,https://cdn.tgdd.vn/Products/Images/1943/201134/tu-lanh-samsung-rs62r5001b4-sv-2-2.jpg ,https://cdn.tgdd.vn/Products/Images/1943/201134/tu-lanh-samsung-rs62r5001b4-sv-3-org.jpg ,https://cdn.tgdd.vn/Products/Images/1943/201134/tu-lanh-samsung-rs62r5001b4-sv-4-org.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC)
	VALUES ('MNNL1','Máy nước nóng trực tiếp Panasonic 4500W DH-4RP1VW','Máy nước nóng trực tiếp Panasonic 4500W DH-4RP1VW',
	'https://cdn.tgdd.vn/Products/Images/1962/225330/panasonic-dh-4rp1vw-1-org.jpg','CNNL','PANA', 4190000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/1962/225330/panasonic-dh-4rp1vw-2-org.jpg ,https://cdn.tgdd.vn/Products/Images/1962/225330/panasonic-dh-4rp1vw-5-org.jpg ,https://cdn.tgdd.vn/Products/Images/1962/225330/panasonic-dh-4rp1vw-7-org.jpg ,https://cdn.tgdd.vn/Products/Images/1962/225330/panasonic-dh-4rp1vw-6-org.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC)
	VALUES ('MNNL2','Máy nước nóng trực tiếp Electrolux 4500W EWE451KB-DWG2 ','Máy nước nóng trực tiếp Electrolux 4500W EWE451KB-DWG2 ',
	'https://cdn.tgdd.vn/Products/Images/1962/256215/ewe451kb-dwg2-2.jpg','CNNL','ELEC', 2790000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/1962/256215/ewe451kb-dwg2-3.jpg ,https://cdn.tgdd.vn/Products/Images/1962/256215/ewe451kb-dwg2-4.jpg , https://cdn.tgdd.vn/Products/Images/1962/256215/ewe451kb-dwg2-5.jpg ,https://cdn.tgdd.vn/Products/Images/1962/256215/ewe451kb-dwg2-7.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC)
	VALUES ('MX1','Máy xay sinh tố Kangaroo KGBL1000X','Máy xay sinh tố Kangaroo KGBL1000X',
	'https://cdn.tgdd.vn/Products/Images/1985/280242/kangarookgbl1000x-1.jpg','MX','KANG', 1190000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/1985/280242/kangarookgbl1000x-2.jpg ,https://cdn.tgdd.vn/Products/Images/1985/280242/kangarookgbl1000x-3.jpg ,https://cdn.tgdd.vn/Products/Images/1985/280242/kangarookgbl1000x-4.jpg , https://cdn.tgdd.vn/Products/Images/1985/280242/kangarookgbl1000x-6.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC)
	VALUES ('MX2','Máy xay sinh tố Electrolux E7TB1-50CW','Máy xay sinh tố Electrolux E7TB1-50CW',
	'https://cdn.tgdd.vn/Products/Images/1985/202253/may-xay-sinh-to-electrolux-e7tb1-50cw-1-org.jpg','MX','ELEC', 1490000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/1985/202253/may-xay-sinh-to-electrolux-e7tb1-50cw-2-org.jpg, https://cdn.tgdd.vn/Products/Images/1985/202253/may-xay-sinh-to-electrolux-e7tb1-50cw-3-org.jpg , https://cdn.tgdd.vn/Products/Images/1985/202253/may-xay-sinh-to-electrolux-e7tb1-50cw-4-org.jpg , https://cdn.tgdd.vn/Products/Images/1985/202253/may-xay-sinh-to-electrolux-e7tb1-50cw-6-org.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC)
	VALUES ('MLN1','Máy lọc nước RO nóng nguội lạnh Kangaroo KG10A3 10 lõi','Máy lọc nước RO nóng nguội lạnh Kangaroo KG10A3 10 lõi',
	'https://cdn.tgdd.vn/Products/Images/3385/193282/kangaroo-kg10a3-1.jpg','MLN','KANG', 6190000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/3385/193282/kangaroo-kg10a3-2.jpg ,https://cdn.tgdd.vn/Products/Images/3385/193282/kangaroo-kg10a3-3.jpg , https://cdn.tgdd.vn/Products/Images/3385/193282/kangaroo-kg10a3-4-1.jpg , https://cdn.tgdd.vn/Products/Images/3385/193282/kangaroo-kg10a3-5-1.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC)
	VALUES ('MLN2','Máy lọc nước RO nóng nguội lạnh Toshiba TWP-W1643SV(W) 4 lõi','Máy lọc nước RO nóng nguội lạnh Toshiba TWP-W1643SV(W) 4 lõi',
	'https://cdn.tgdd.vn/Products/Images/3385/204083/may-loc-nuoc-ro-toshiba-twp-w1643sv-w-1-1-org.jpg','MLN','TOS', 5990000 , 12, 'active', 
	'https://cdn.tgdd.vn/Products/Images/3385/204083/may-loc-nuoc-ro-toshiba-twp-w1643sv-w-2-org.jpg ,https://cdn.tgdd.vn/Products/Images/3385/204083/may-loc-nuoc-ro-toshiba-twp-w1643sv-w-3-org.jpg , https://cdn.tgdd.vn/Products/Images/3385/204083/may-loc-nuoc-ro-toshiba-twp-w1643sv-w-4-org.jpg , https://cdn.tgdd.vn/Products/Images/3385/204083/may-loc-nuoc-ro-toshiba-twp-w1643sv-w-6-org.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('MRC1','Máy rửa bát độc lập Electrolux ESF5512LOX','Máy rửa bát độc lập Electrolux ESF5512LOX',
    'https://cdn.tgdd.vn/Products/Images/5475/202733/may-rua-chen-electrolux-esf5512lox-2-org.jpg','MRC','ELEC', 1800000 , 12,'active',
    'https://cdn.tgdd.vn/Products/Images/5475/202733/Slider/vi-vn-thiet-ke-electrolux-esf5512lox-2.jpg ,
    https://cdn.tgdd.vn/Products/Images/5475/299897/Slider/may-rua-chen-bosch-sms6zci49e638307316866807782-1020x570.jpg,https://cdn.tgdd.vn/Products/Images/5475/299897/Slider/may-rua-chen-bosch-sms6zci49e-chuong-trinh-1020x570.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('MRC2','Máy rửa bát độc lập Bosch SMS6ZCI49E','Máy rửa bát độc lập Bosch SMS6ZCI49E',
    'https://cdn.tgdd.vn/Products/Images/5475/299897/may-rua-chen-bosch-sms6zci49e-1-1.jpg','MRC','BO', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/5475/299897/may-rua-chen-bosch-sms6zci49e-2-1.jpg ,https://cdn.tgdd.vn/Products/Images/5475/299897/may-rua-chen-bosch-sms6zci49e-5.jpg,https://cdn.tgdd.vn/Products/Images/5475/299897/may-rua-chen-bosch-sms6zci49e-7.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('MRC3','Máy rửa bát độc lập Galanz W45A3A401S-0E1(SS)','Máy rửa bát độc lập Galanz W45A3A401S-0E1(SS)',
    'https://cdn.tgdd.vn/Products/Images/5475/232927/galanz-w45a3a401s-0e1-ss-1850w-2-org.jpg','MRC','GA', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/5475/232927/Slider/vi-vn-ddnb2-780x433.jpg ,https://cdn.tgdd.vn/Products/Images/5475/232927/Slider/thietke-780x433.jpg,https://cdn.tgdd.vn/Products/Images/5475/232927/Slider/34bu%CC%9B%CC%83aa%CC%86n-780x433.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('LN1','Lò nướng BlueStone EOB-7567 45 lít','Lò nướng BlueStone EOB-7567 45 lít',
    'https://cdn.tgdd.vn/Products/Images/2063/203003/lo-nuong-bluestone-eob-7567-2-1-org.jpg','LN','BLS', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/2063/203003/Slider/lo-nuong-bluestone-eob-7567638108475849745575.jpg ,https://cdn.tgdd.vn/Products/Images/2063/203003/Slider/220921-0305032.png,https://cdn.tgdd.vn/Products/Images/2063/203003/Slider/220921-0305033.png');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('LN2','Lò nướng Sunhouse Mama SHD4240 40 lít','Lò nướng Sunhouse Mama SHD4240 40 lít',
    'https://cdn.tgdd.vn/Products/Images/2063/225587/sunhouse-mama-shd4240-40-lit-2-org.jpg','LN','SH', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/2063/225587/Slider/sunhouse-mama-shd4240-40-lit638076708649327715.jpg, https://cdn.tgdd.vn/Products/Images/2063/225587/Slider/sunhouse-mama-shd4240-40-lit638076708651317718.jpg,https://cdn.tgdd.vn/Products/Images/2063/225587/Slider/sunhouse-mama-shd4240-40-lit638076708655117811.gif');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('LN3','Lò nướng Sharp EO-A384RCSV-ST 38 lít','Lò nướng Sharp EO-A384RCSV-ST 38 lít',
    'https://cdn.tgdd.vn/Products/Images/2063/165979/sharp-eo-a384rcsv-st-2-org.jpg','LN','SA', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/2063/165979/Slider/tinh-nang-3-(1)-min.jpg,https://cdn.tgdd.vn/Products/Images/2063/165979/Slider/tinh-nang-4-(1)-min.jpg,https://cdn.tgdd.vn/Products/Images/2063/165979/Slider/tinh-nang-7-(1)-min.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('QDH1','Quạt điều hòa Sunhouse SHD7734','Quạt điều hòa Sunhouse SHD7734',
    'https://cdn.tgdd.vn/Products/Images/7498/235382/sunhouse-shd7734-040923-024456-600x600.jpg','Q','SH', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/7498/235382/Slider/THIETKE1-780x433.jpg,https://cdn.tgdd.vn/Products/Images/7498/235382/Slider/congsuat-780x433.jpg,https://cdn.tgdd.vn/Products/Images/7498/235382/Slider/dakho-780x433.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('QDH2','Quạt điều hòa Puwa AC-38AR','Quạt điều hòa Puwa AC-38AR',
    'https://cdn.tgdd.vn/Products/Images/7498/236017/puwa-ac-38ar-16-300x300-600x600.jpg','Q','PU', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/7498/236017/Slider/230321-1137270.jpg,https://cdn.tgdd.vn/Products/Images/7498/236017/Slider/230321-1137407.jpg,https://cdn.tgdd.vn/Products/Images/7498/236017/Slider/230321-1137301.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('QDH3','Quạt điều hòa Hommy RPD-80','Quạt điều hòa Hommy RPD-80',
    'https://cdn.tgdd.vn/Products/Images/7498/235848/hommy-rpd-80-040923-024948-600x600.jpg','Q','HO', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/7498/235848/Slider/quat-dieu-hoa-hommy-rpd-80-200321-0800411.jpg,https://cdn.tgdd.vn/Products/Images/7498/235848/Slider/quat-dieu-hoa-hommy-rpd-80-200321-0800422.jpg,https://cdn.tgdd.vn/Products/Images/7498/235848/Slider/quat-dieu-hoa-hommy-rpd-80-200321-0800444.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('MNB1','Máy nướng bánh mì Delonghi CTOV2103.BG','Máy nướng bánh mì Delonghi CTOV2103.BG',
    'https://cdn.tgdd.vn/Products/Images/12318/283059/may-nuong-banh-mi-delonghi-ctov2103bg-090223-110802-600x600.jpg','TBNB','DE', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/12318/283059/may-nuong-banh-mi-delonghi-ctov2103bg-5.jpg,https://cdn.tgdd.vn/Products/Images/12318/283059/may-nuong-banh-mi-delonghi-ctov2103bg-6.jpg,https://cdn.tgdd.vn/Products/Images/12318/283059/may-nuong-banh-mi-delonghi-ctov2103bg-7.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('MDT1','Máy đánh trứng AVA HM9103-GS','Máy đánh trứng AVA HM9103-GS',
    'https://cdn.tgdd.vn/Products/Images/2262/249157/249157-600x600.jpg','TBNB','AVA', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/2262/249157/Slider/chuc-nang-min.jpg,https://cdn.tgdd.vn/Products/Images/2262/249157/Slider/dieu-khien-min.jpg,https://cdn.tgdd.vn/Products/Images/2262/249157/Slider/dong-co-min.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('MDT2','Máy đánh trứng Philips HR3705/20','Máy đánh trứng Philips HR3705/20',
    'https://cdn.tgdd.vn/Products/Images/2262/193887/193887-600x600.jpg','TBNB','PHI', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/2262/193887/Slider/vi-vn-1.jpg,https://cdn.tgdd.vn/Products/Images/2262/193887/Slider/vi-vn-2.jpg,https://cdn.tgdd.vn/Products/Images/2262/193887/Slider/vi-vn-3.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('MNB2','Máy nhồi bột đánh trứng Philips HR3745/00','Máy nhồi bột đánh trứng Philips HR3745/00',
    'https://cdn.tgdd.vn/Products/Images/2262/307828/may-danh-trung-philips-hr3745-00-160623-063653-600x600.jpg','TBNB','PHI', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/2262/307828/may-danh-trung-philips-hr3745-00-2.jpg,https://cdn.tgdd.vn/Products/Images/2262/307828/may-danh-trung-philips-hr3745-00-3.jpg,https://cdn.tgdd.vn/Products/Images/2262/307828/may-danh-trung-philips-hr3745-00-5.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('MLKK1','Máy lọc không khí Sharp FP-J80EV-H 48W','Máy lọc không khí Sharp FP-J80EV-H 48W',
    'https://cdn.tgdd.vn/Products/Images/5473/202552/202552-600x600.jpg','MLKK','SA', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/5473/202552/Slider/-slider-2.jpg.png,https://cdn.tgdd.vn/Products/Images/5473/202552/Slider/-na%CC%82%CC%81m-jpg.jpg,https://cdn.tgdd.vn/Products/Images/5473/202552/Slider/vi-vn-slider-4.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('MLKK2','Máy lọc không khí Sunhouse SHD-60AP9760 48W','Máy lọc không khí Sunhouse SHD-60AP9760 48W',
    'https://cdn.tgdd.vn/Products/Images/5473/240251/240251-600x600.jpg','MLKK','SH', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/5473/240251/Slider/vi-vn-vi-vn-sunhouse-shd-60ap9760-220721-0952021.jpg,https://cdn.tgdd.vn/Products/Images/5473/240251/Slider/vi-vn-sunhouse-shd-60ap9760-220721-0952036.jpg,https://cdn.tgdd.vn/Products/Images/5473/240251/Slider/sunhouse-shd-60ap9760-220721-0952023.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('MLKK3','Máy lọc không khí Samsung AX60R5080WD/SV 60W','Máy lọc không khí Samsung AX60R5080WD/SV 60W',
    'https://cdn.tgdd.vn/Products/Images/5473/215712/215712-1-2-600x600.jpg','MLKK','SS', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/5473/215712/Slider/may-loc-khong-khi-samsung-ax60r5080wd-sv637819346735396018.jpg,https://cdn.tgdd.vn/Products/Images/5473/215712/Slider/vi-vn-thiet-ke.jpg,https://cdn.tgdd.vn/Products/Images/5473/215712/Slider/-pham-vi.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('TBSA1','Máy sưởi gốm Ceramic Mutosi MCH-2000','Máy sưởi gốm Ceramic Mutosi MCH-2000',
    'https://cdn.tgdd.vn/Products/Images/2428/292017/mutosi-mch2000-181022-113957-600x600.jpg','TBSA','CEMU', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/2428/292017/Slider/mutosi-mch2000638066079715746558.jpg,https://cdn.tgdd.vn/Products/Images/2428/292017/Slider/mutosi-mch2000638066079717746658.jpg,https://cdn.tgdd.vn/Products/Images/2428/292017/Slider/mutosi-mch2000638066079723696462.gif');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('TBSA2','Quạt sưởi Sunhouse SHD7005','Quạt sưởi Sunhouse SHD7005',
    'https://cdn.tgdd.vn/Products/Images/2428/193530/quat-suoi-sunhouse-shd7005-kg-1-300x300.JPG','TBSA','SH', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/2428/193530/Slider/vi-vn-sunhouse-shd7005-kg-1.jpg,https://cdn.tgdd.vn/Products/Images/2428/193530/Slider/vi-vn-sunhouse-shd7005-kg-3.jpg,https://cdn.tgdd.vn/Products/Images/2428/193530/Slider/vi-vn-sunhouse-shd7005-kg-5.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('TBSA3','Quạt sưởi hồng ngoại Sunhouse SHD7022','Quạt sưởi hồng ngoại Sunhouse SHD7022',
    'https://cdn.tgdd.vn/Products/Images/2428/149425/hong-ngoai-sunhouse-shd7022-ava-300x300.jpg','TBSA','SH', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/2428/149425/Slider/271020-0319134.jpg,https://cdn.tgdd.vn/Products/Images/2428/149425/Slider/271020-0319145.jpg,https://cdn.tgdd.vn/Products/Images/2428/149425/Slider/hong-ngoai-sunhouse-shd7022638025403986312131.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('TBSA4','Đèn sưởi nhà tắm Kangaroo KG247V 550W','Đèn sưởi nhà tắm Kangaroo KG247V 550W',
    'https://cdn.tgdd.vn/Products/Images/2302/212931/den-suoi-kangaroo-kg247v-300x300.jpg','TBSA','KANG', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/2302/212931/Slider/vi-vn-dmx_den-suoi_cong-suat.jpg,https://cdn.tgdd.vn/Products/Images/2302/212931/Slider/vi-vn-dmx_den-suoi_cong-nghe.jpg,https://cdn.tgdd.vn/Products/Images/2302/212931/Slider/vi-vn-dmx_den-suoi_thao-lap.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('B1','Bếp từ 3 vùng nấu âm Electrolux E6203IOK 5800W','Bếp từ 3 vùng nấu âm Electrolux E6203IOK 5800W',
    'https://cdn.tgdd.vn/Products/Images/1982/234391/electrolux-e6203iok-11-600x600.jpg','B','ELEC', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/1982/234391/Slider/E6203IOKtk-780x433.jpg,https://cdn.tgdd.vn/Products/Images/1982/234391/Slider/slidercongsuat-min-780x433.jpg,https://cdn.tgdd.vn/Products/Images/1982/234391/Slider/E6203IOKnaunhanh-780x433.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('B2','Bếp từ đôi âm Electrolux EHI7280BB 3700W','Bếp từ đôi âm Electrolux EHI7280BB 3700W',
    'https://cdn.tgdd.vn/Products/Images/1982/235079/electrolux-ehi7280bb-12-600x600.jpg','B','ELEC', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/1982/235079/Slider/vi-vn-electrolux-ehi7280bb-181121-022536.jpg,https://cdn.tgdd.vn/Products/Images/1982/235079/Slider/vi-vn-electrolux-ehi7280bb-230921-021632.jpg,https://cdn.tgdd.vn/Products/Images/1982/235079/Slider/vi-vn-electrolux-ehi7280bb-230921-023001.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('B3','Bếp từ 4 vùng nấu âm Electrolux EHXD875FAK 7400W','Bếp từ 4 vùng nấu âm Electrolux EHXD875FAK 7400W',
    'https://cdn.tgdd.vn/ValueIcons/premium.png','B','ELEC', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/1982/175149/Slider/vi-vn-2-780x433-1.jpg,https://cdn.tgdd.vn/Products/Images/1982/175149/Slider/vi-vn-3.jpg,https://cdn.tgdd.vn/Products/Images/1982/175149/Slider/vi-vn-6.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('B4','Bếp từ đơn Sunhouse SHD6159 1800W','Bếp từ đơn Sunhouse SHD6159 1800W',
    'https://cdn.tgdd.vn/Products/Images/1982/260284/260284-600x600-2.jpg','B','SH', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/1982/260284/Slider/be-p-tu-sunhouse-shd6159637844237762291410.jpg,https://cdn.tgdd.vn/Products/Images/1982/260284/Slider/be-p-tu-sunhouse-shd6159637844237759301100.jpg,https://cdn.tgdd.vn/Products/Images/1982/260284/Slider/be-p-tu-sunhouse-shd6159637844237761091283.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('DT1','OPPO Reno10 Pro 5G','OPPO Reno10 Pro 5G',
    'https://cdn.tgdd.vn/Products/Images/42/306979/oppo-reno10-pro-grey-thumbnew-600x600.jpg','DT','OP', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/42/306979/Slider/vi-vn-oppo-reno10-pro-5g-slider-(1).jpg,https://cdn.tgdd.vn/Products/Images/42/306979/Slider/oppo-reno10-pro-5g-slider-10-1020x570.jpg,https://cdn.tgdd.vn/Products/Images/42/306979/Slider/vi-vn-oppo-reno10-pro-5g-slider-(3).jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('DT2','OPPO A57 128GB','OPPO A57 128GB',
    'https://cdn.tgdd.vn/Products/Images/42/285082/oppo-a57-xanh-thumb-1-600x600.jpeg','DT','OP', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/42/285082/Slider/oppo-a57-4g637916782091781459-1020x570.jpg,https://cdn.tgdd.vn/Products/Images/42/285082/Slider/oppo-a57-4g637916782093061646-1020x570.jpg,https://cdn.tgdd.vn/Products/Images/42/285082/Slider/oppo-a57-4g637916782095512041-1020x570.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('DT3','Vivo V25 series','Vivo V25 series',
    'https://cdn.tgdd.vn/Products/Images/42/283148/vivo-v25-5g-vang-thumb-1-1-600x600.jpg','DT','VV', 1200000 , 12, 'active',
    'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:80/plain/https://cellphones.com.vn/media/catalog/product/v/i/vivo-v25.png,https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:80/plain/https://cellphones.com.vn/media/catalog/product/6/3/637987658869475958_vivo-v25e-den-5.jpg,https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:80/plain/https://cellphones.com.vn/media/catalog/product/6/3/637987661253416302_vivo-v25e-vang-4.jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('DT4','Xiaomi 13T Pro 5G','Xiaomi 13T Pro 5G',
    'https://cdn.tgdd.vn/Products/Images/42/309816/xiaomi-13t-xanh-thumb-1-600x600.jpg','DT','XI', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/42/309816/Slider/vi-vn-xiaomi-13t-pro-slider--(1).jpg,https://cdn.tgdd.vn/Products/Images/42/309816/Slider/vi-vn-xiaomi-13t-pro-slider--(3).jpg,https://cdn.tgdd.vn/Products/Images/42/309816/Slider/vi-vn-xiaomi-13t-pro-slider--(2).jpg');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, PRODUCT_SALEPRICE ,warranty_period, PRODUCT_STATUS, IMAGE_SRC) 
    VALUES ('DT5','Samsung Galaxy S22 Ultra 5G 128GB','Samsung Galaxy S22 Ultra 5G 128GB',
    'https://cdn.tgdd.vn/Products/Images/42/235838/Galaxy-S22-Ultra-Burgundy-600x600.jpg','DT','SS', 1200000 , 12, 'active',
    'https://cdn.tgdd.vn/Products/Images/42/235838/Slider/samsung-galaxy-s22-ultra-1020x570.jpg,https://cdn.tgdd.vn/Products/Images/42/235838/Slider/2.ButSpen-1020x570.jpg,https://cdn.tgdd.vn/Products/Images/42/235838/Slider/3.Trainghiemthigiac-1020x570.jpg');


-- CODE_DISCOUNT
INSERT INTO CODE_DISCOUNT (CODE_ID,CODE_NAME, CODE_PERCENT, CODE_DESCRIPTION) 
    VALUES ('CODE1','Khai trương trang web', 15 , 'Mừng ngày khai trương trang web 2/12/2023');

-- PROMOTION
INSERT INTO PROMOTION (PROMOTION_ID,PROMOTION_CODE, PROMOTION_STARTDATE, PROMOTION_ENDDATE, PRODUCT_ID) 
    VALUES ('PROMO1','CODE1', '2023-12-01', '2023-12-31', 'TV1');
INSERT INTO PROMOTION (PROMOTION_ID,PROMOTION_CODE, PROMOTION_STARTDATE, PROMOTION_ENDDATE, PRODUCT_ID) 
    VALUES ('PROMO2','CODE1', '2023-12-01', '2023-12-31', 'TV2');
INSERT INTO PROMOTION (PROMOTION_ID,PROMOTION_CODE, PROMOTION_STARTDATE, PROMOTION_ENDDATE, PRODUCT_ID)
    VALUES ('PROMO3','CODE1', '2023-12-01', '2023-12-31', 'TV3');
INSERT INTO PROMOTION (PROMOTION_ID,PROMOTION_CODE, PROMOTION_STARTDATE, PROMOTION_ENDDATE, PRODUCT_ID)
    VALUES ('PROMO4','CODE1', '2023-12-01', '2023-12-31', 'TV4');
INSERT INTO PROMOTION (PROMOTION_ID,PROMOTION_CODE, PROMOTION_STARTDATE, PROMOTION_ENDDATE, PRODUCT_ID)
    VALUES ('PROMO5','CODE1', '2023-12-01', '2023-12-31', 'TV5');
INSERT INTO PROMOTION (PROMOTION_ID,PROMOTION_CODE, PROMOTION_STARTDATE, PROMOTION_ENDDATE, PRODUCT_ID)
    VALUES ('PROMO6','CODE1', '2023-12-01', '2023-12-31', 'TV6');
INSERT INTO PROMOTION (PROMOTION_ID,PROMOTION_CODE, PROMOTION_STARTDATE, PROMOTION_ENDDATE, PRODUCT_ID)
    VALUES ('PROMO7','CODE1', '2023-12-01', '2023-12-31', 'MG1');
INSERT INTO PROMOTION (PROMOTION_ID,PROMOTION_CODE, PROMOTION_STARTDATE, PROMOTION_ENDDATE, PRODUCT_ID)
    VALUES ('PROMO8','CODE1', '2023-12-01', '2023-12-31', 'MG2');
INSERT INTO PROMOTION (PROMOTION_ID,PROMOTION_CODE, PROMOTION_STARTDATE, PROMOTION_ENDDATE, PRODUCT_ID)
    VALUES ('PROMO9','CODE1', '2023-12-01', '2023-12-31', 'MG3');
INSERT INTO PROMOTION (PROMOTION_ID,PROMOTION_CODE, PROMOTION_STARTDATE, PROMOTION_ENDDATE, PRODUCT_ID)
    VALUES ('PROMO10','CODE1', '2023-12-01', '2023-12-31', 'TBSA1');
INSERT INTO PROMOTION (PROMOTION_ID,PROMOTION_CODE, PROMOTION_STARTDATE, PROMOTION_ENDDATE, PRODUCT_ID)
    VALUES ('PROMO11','CODE1', '2023-12-01', '2023-12-31', 'TBSA2');
INSERT INTO PROMOTION (PROMOTION_ID,PROMOTION_CODE, PROMOTION_STARTDATE, PROMOTION_ENDDATE, PRODUCT_ID)
    VALUES ('PROMO12','CODE1', '2023-12-01', '2023-12-31', 'TL1');
INSERT INTO PROMOTION (PROMOTION_ID,PROMOTION_CODE, PROMOTION_STARTDATE, PROMOTION_ENDDATE, PRODUCT_ID)
    VALUES ('PROMO13','CODE1', '2023-12-01', '2023-12-31', 'TL2');

-- WAREHOUSE: thêm bằng trigger, mặc định quantity = 0

-- ORDERS


-- ORDER_DETAILS


-- REVENUE


-- FEEDBACK


-- SITE_TRAFFIC


-- WARRANTY


-- TRIGGER


