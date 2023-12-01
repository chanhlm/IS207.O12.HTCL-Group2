CREATE TABLE ROLES(
    ROLE_ID INT NOT NULL AUTO_INCREMENT,
    ROLE_NAME VARCHAR(50) NOT NULL, 
    PRIMARY KEY (ROLE_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into ROLES(ROLE_NAME) values('admin');
insert into ROLES(ROLE_NAME) values('user');

CREATE TABLE USERS(
    USER_ID VARCHAR(10) NOT NULL ,
    USER_NAME VARCHAR(50) NOT NULL,
    USER_PASSWORD VARCHAR(50),
    USER_EMAIL VARCHAR(50),
    USER_PHONE VARCHAR(50) NOT NULL,
    USER_ADDRESS VARCHAR(50),
    USER_ROLE int NOT NULL,
    USER_STATE VARCHAR(50) NOT NULL,
    USER_IMAGE VARCHAR(100),
    CREATE_DATE DATE NOT NULL,
    LAST_LOGIN DATE NOT NULL,
    PRIMARY KEY (USER_ID, USER_PHONE),
    FOREIGN KEY (USER_ROLE) REFERENCES ROLES(ROLE_ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into USERS(USER_ID, USER_NAME, USER_PASSWORD, USER_EMAIL, USER_PHONE, USER_ROLE, USER_STATE, CREATE_DATE, LAST_LOGIN) 
            values('AD1' ,'admin', null, null, '+84359297916', 1, 'active', '2020-11-30', '2020-11-30');


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
    BRAND_NAME VARCHAR(50) NOT NULL ,
    CONTRY VARCHAR(50) NOT NULL ,
    BRAND_IMAGE VARCHAR(50) NOT NULL,
    NUMBER_PRODUCT INT NOT NULL,
    BRAND_DESCRIPTION VARCHAR(50) NOT NULL ,
    PRIMARY KEY (BRAND_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into BRANDS(BRAND_ID ,BRAND_NAME, CONTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION) 
    values('SS','Samsung', 'Korea', 'https://images.samsung.com/is/image/samsung/assets/vn/about-us/brand/logo/pc/720_600_1.png?$720_N_PNG$', 0, 'Samsung');
insert into BRANDS(BRAND_ID ,BRAND_NAME, CONTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION) 
    values('LG','LG', 'Korea', 'https://www.lg.com/content/dam/lge/global/our-brand/src/mocks/bs0002/brand-elements-logo-primary-d.svg', 0, 'LG');
insert into BRANDS(BRAND_ID ,BRAND_NAME, CONTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION) 
    values('ELEC','Electrolux', 'Thailand', 'https://www.electrolux.vn/-/media/Images/Electrolux/Global/Brand-Logos/Electrolux-Logo-Black.png', 0, 'Electrolux');
insert into BRANDS(BRAND_ID ,BRAND_NAME, CONTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION) 
    values('TOS','Toshiba', 'Japan', 'https://www.toshiba.com.vn/images/logo.png', 0, 'Toshiba');
insert into BRANDS(BRAND_ID ,BRAND_NAME, CONTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION) 
    values('PANA','Panasonic', 'Japan', 'https://www.panasonic.com/content/dam/pim/vn/en/brand-logo/panasonic-logo.png', 0, 'Panasonic');
insert into BRANDS(BRAND_ID ,BRAND_NAME, CONTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION) 
    values('HITA','Hitachi', 'Japan', 'https://www.hitachi.com.vn/images/logo.png', 0, 'Hitachi');
insert into BRANDS(BRAND_ID ,BRAND_NAME, CONTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION) 
    values('AQUA','Aqua', 'Vietnam', 'https://www.aqua.com.vn/wp-content/uploads/2019/10/logo-aqua.png', 0, 'Aqua');
insert into BRANDS(BRAND_ID ,BRAND_NAME, CONTRY, BRAND_IMAGE, NUMBER_PRODUCT, BRAND_DESCRIPTION) 
    values('KANG','Kangaroo', 'Vietnam', 'https://kangaroo.vn/wp-content/uploads/2019/10/logo-kangaroo.png', 0, 'Kangaroo');


CREATE TABLE CATEGORIES(
    CATEGORY_ID VARCHAR(10) NOT NULL,
    CATEGORY_NAME VARCHAR(50) NOT NULL ,
    CATEGORY_IMAGE VARCHAR(200) NOT NULL,
    NUMBER_PRODUCT INT NOT NULL,
    CATEGORY_DESCRIPTION VARCHAR(50) NOT NULL,
    primary key (CATEGORY_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE PRODUCTS(
    PRODUCT_ID VARCHAR(10) NOT NULL,
    PRODUCT_NAME VARCHAR(50) NOT NULL ,
    PRODUCT_DESCRIPTION VARCHAR(50) NOT NULL ,
    PRODUCT_IMAGE VARCHAR(50) NOT NULL,
    CATEGORY_ID VARCHAR(10) NOT NULL,
    BRAND_ID VARCHAR(10) NOT NULL,
    -- tính bằng tháng
    warranty_period int NOT NULL,
    PRODUCT_STATUS VARCHAR(50) NOT NULL,
    PRIMARY KEY (PRODUCT_ID),
    FOREIGN KEY (CATEGORY_ID) REFERENCES CATEGORIES(CATEGORY_ID),
    FOREIGN KEY (BRAND_ID) REFERENCES BRANDS(BRAND_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- TV1	Smart Tivi Samsung 4K Crystal UHD 65 inch UA65AU8100	Smart Tivi Samsung 4K Crystal UHD 65 inch UA65AU8100	https://cdn.tgdd.vn/Products/Images/1942/235794/led-4k-samsung-ua65au8100-2.jpg	TV	12	null
-- TV2	Smart Tivi QLED 4K 50 inch Samsung QA50Q65A	Smart Tivi QLED 4K 50 inch Samsung QA50Q65A	https://cdn.tgdd.vn/Products/Images/1942/235641/qled-4k-samsung-qa50q65a-2.jpg	TV	12	null
-- TV3	Smart Tivi Samsung 4K 43 inch UA43AU7002	Smart Tivi Samsung 4K 43 inch UA43AU7002	https://cdn.tgdd.vn/Products/Images/1942/279935/untitled-11.jpeg	TV	12	null
-- TV4	Smart Tivi Samsung 32 inch UA32T4300	Smart Tivi Samsung 32 inch UA32T4300	https://cdn.tgdd.vn/Products/Images/1942/219400/samsung-ua32t4300-2-1-org.jpg	TV	12	null
-- TV5	Smart Tivi Samsung 4K 55 inch UA55CU8000	Smart Tivi Samsung 4K 55 inch UA55CU8000	https://cdn.tgdd.vn/Products/Images/1942/303231/smart-tivi-samsung-4k-55-inch-ua55cu8000-1.jpg	TV	12	null
-- TV6	Smart Tivi QLED 4K 75 inch Samsung QA75Q80C	Smart Tivi QLED 4K 75 inch Samsung QA75Q80C	https://cdn.tgdd.vn/Products/Images/1942/303214/smart-tivi-qled-4k-75-inch-samsung-qa75q80c-01.jpg	TV	12	null
-- TV7	Smart Tivi Samsung 4K Crystal UHD 85 inch UA85BU8000	Smart Tivi Samsung 4K Crystal UHD 85 inch UA85BU8000	https://cdn.tgdd.vn/Products/Images/1942/273377/gu65bu8079uxzg_002_r-perspective_black.jpg	TV	12	null
-- TV8	Smart Tivi Neo QLED 4K 65 inch Samsung QA65QN90C	Smart Tivi Neo QLED 4K 65 inch Samsung QA65QN90C	https://cdn.tgdd.vn/Products/Images/1942/303172/smart-tivi-neo-qled-4k-65-inch-samsung-qa65qn90c-1.jpg	TV	12	null
-- TV9	Smart Tivi QLED 4K 85 inch Samsung QA85Q80B	Smart Tivi QLED 4K 85 inch Samsung QA85Q80B	https://cdn.tgdd.vn/Products/Images/1942/273410/smart-tivi-qled-4k-85-inch-samsung-qa85q80b-2.jpg	TV	12	null
-- TV10	Smart Tivi Neo QLED 4K 98 inch Samsung QA98QN90A	Smart Tivi Neo QLED 4K 98 inch Samsung QA98QN90A	https://cdn.tgdd.vn/Products/Images/1942/250263/3-org-org.jpg	TV	12	null
-- TV11	Smart Tivi OLED Samsung 4K 77 inch QA77S90CA	Smart Tivi OLED Samsung 4K 77 inch QA77S90CA	https://cdn.tgdd.vn/Products/Images/1942/304397/smart-tivi-oled-samsung-4k-77-inch-qa77s90ca-1.jpg	TV	12	null
-- TV12	Smart Tivi Neo QLED 8K 85 inch Samsung QA85QN900C	Smart Tivi Neo QLED 8K 85 inch Samsung QA85QN900C	https://cdn.tgdd.vn/Products/Images/1942/303159/smart-tivi-neo-qled-8k-85-inch-samsung-qa85qn900c-1.jpg	TV	12	null
-- TV13	Smart Tivi QLED 4K 98 inch Samsung QA98Q80C	Smart Tivi QLED 4K 98 inch Samsung QA98Q80C	https://cdn.tgdd.vn/Products/Images/1942/305837/smart-tivi-qled-4k-98-inch-samsung-qa98q80c-1.jpg	TV	12	null
-- TV14	Smart Tivi Samsung 4K Crystal UHD 50 inch UA50AU7200	Smart Tivi Samsung 4K Crystal UHD 50 inch UA50AU7200	https://cdn.tgdd.vn/Products/Images/1942/235800/led-4k-samsung-ua50au7200-1.jpg	TV	12	null
-- TV15	Google Tivi Sony 4K 55 inch KD-55X80K	Google Tivi Sony 4K 55 inch KD-55X80K	https://cdn.tgdd.vn/Products/Images/1942/274761/android-sony-4k-55-inch-kd-55x80k-1.jpg	TV	12	null
-- TV16	Google Tivi Sony 4K 43 inch KD-43X75K	Google Tivi Sony 4K 43 inch KD-43X75K	https://cdn.tgdd.vn/Products/Images/1942/275517/google-sony-4k-43-inch-kd-43x75k-1.jpg	TV	12	null



INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, warranty_period, PRODUCT_STATUS) 
    VALUES ('TV1','Smart Tivi Samsung 4K Crystal UHD 65 inch UA65AU8100','Smart Tivi Samsung 4K Crystal UHD 65 inch UA65AU8100','https://cdn.tgdd.vn/Products/Images/1942/235794/led-4k-samsung-ua65au8100-2.jpg','TV','SS', 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, warranty_period, PRODUCT_STATUS)
    VALUES ('TV2','Smart Tivi QLED 4K 50 inch Samsung QA50Q65A','Smart Tivi QLED 4K 50 inch Samsung QA50Q65A','https://cdn.tgdd.vn/Products/Images/1942/235641/qled-4k-samsung-qa50q65a-2.jpg','TV','SS', 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, warranty_period, PRODUCT_STATUS)
    VALUES ('TV3','Smart Tivi Samsung 4K 43 inch UA43AU7002','Smart Tivi Samsung 4K 43 inch UA43AU7002','https://cdn.tgdd.vn/Products/Images/1942/279935/untitled-11.jpeg','TV','SS', 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, warranty_period, PRODUCT_STATUS)
    VALUES ('TV4','Smart Tivi Samsung 32 inch UA32T4300','Smart Tivi Samsung 32 inch UA32T4300','https://cdn.tgdd.vn/Products/Images/1942/219400/samsung-ua32t4300-2-1-org.jpg','TV','SS', 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, warranty_period, PRODUCT_STATUS)
    VALUES ('TV5','Smart Tivi Samsung 4K 55 inch UA55CU8000','Smart Tivi Samsung 4K 55 inch UA55CU8000','https://cdn.tgdd.vn/Products/Images/1942/303231/smart-tivi-samsung-4k-55-inch-ua55cu8000-1.jpg','TV','SS', 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, warranty_period, PRODUCT_STATUS)
    VALUES ('TV6','Smart Tivi QLED 4K 75 inch Samsung QA75Q80C','Smart Tivi QLED 4K 75 inch Samsung QA75Q80C','https://cdn.tgdd.vn/Products/Images/1942/303214/smart-tivi-qled-4k-75-inch-samsung-qa75q80c-01.jpg','TV','SS', 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, warranty_period, PRODUCT_STATUS)
    VALUES ('TV7','Smart Tivi Samsung 4K Crystal UHD 85 inch UA85BU8000','Smart Tivi Samsung 4K Crystal UHD 85 inch UA85BU8000','https://cdn.tgdd.vn/Products/Images/1942/273377/gu65bu8079uxzg_002_r-perspective_black.jpg','TV','SS', 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, warranty_period, PRODUCT_STATUS)
    VALUES ('TV8','Smart Tivi Neo QLED 4K 65 inch Samsung QA65QN90C','Smart Tivi Neo QLED 4K 65 inch Samsung QA65QN90C','https://cdn.tgdd.vn/Products/Images/1942/303172/smart-tivi-neo-qled-4k-65-inch-samsung-qa65qn90c-1.jpg','TV','SS', 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, warranty_period, PRODUCT_STATUS)
    VALUES ('TV9','Smart Tivi QLED 4K 85 inch Samsung QA85Q80B','Smart Tivi QLED 4K 85 inch Samsung QA85Q80B','https://cdn.tgdd.vn/Products/Images/1942/273410/smart-tivi-qled-4k-85-inch-samsung-qa85q80b-2.jpg','TV','SS', 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, warranty_period, PRODUCT_STATUS)
    VALUES ('TV10','Smart Tivi Neo QLED 4K 98 inch Samsung QA98QN90A','Smart Tivi Neo QLED 4K 98 inch Samsung QA98QN90A','https://cdn.tgdd.vn/Products/Images/1942/250263/3-org-org.jpg','TV','SS', 12, 'active');  
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, warranty_period, PRODUCT_STATUS)
    VALUES ('TV11','Smart Tivi OLED Samsung 4K 77 inch QA77S90CA','Smart Tivi OLED Samsung 4K 77 inch QA77S90CA','https://cdn.tgdd.vn/Products/Images/1942/304397/smart-tivi-oled-samsung-4k-77-inch-qa77s90ca-1.jpg','TV','SS', 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, warranty_period, PRODUCT_STATUS)
    VALUES ('TV12','Smart Tivi Neo QLED 8K 85 inch Samsung QA85QN900C','Smart Tivi Neo QLED 8K 85 inch Samsung QA85QN900C','https://cdn.tgdd.vn/Products/Images/1942/303159/smart-tivi-neo-qled-8k-85-inch-samsung-qa85qn900c-1.jpg','TV','SS', 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, warranty_period, PRODUCT_STATUS)
    VALUES ('TV13','Smart Tivi QLED 4K 98 inch Samsung QA98Q80C','Smart Tivi QLED 4K 98 inch Samsung QA98Q80C','https://cdn.tgdd.vn/Products/Images/1942/305837/smart-tivi-qled-4k-98-inch-samsung-qa98q80c-1.jpg','TV','SS', 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, warranty_period, PRODUCT_STATUS)
    VALUES ('TV14','Smart Tivi Samsung 4K Crystal UHD 50 inch UA50AU7200','Smart Tivi Samsung 4K Crystal UHD 50 inch UA50AU7200','https://cdn.tgdd.vn/Products/Images/1942/235800/led-4k-samsung-ua50au7200-1.jpg','TV','SS', 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, warranty_period, PRODUCT_STATUS)
    VALUES ('TV15','Google Tivi Sony 4K 55 inch KD-55X80K','Google Tivi Sony 4K 55 inch KD-55X80K','https://cdn.tgdd.vn/Products/Images/1942/274761/android-sony-4k-55-inch-kd-55x80k-1.jpg','TV','SS', 12, 'active');
INSERT INTO PRODUCTS (PRODUCT_ID,PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE, CATEGORY_ID, BRAND_ID, warranty_period, PRODUCT_STATUS)
    VALUES ('TV16','Google Tivi Sony 4K 43 inch KD-43X75K','Google Tivi Sony 4K 43 inch KD-43X75K','https://cdn.tgdd.vn/Products/Images/1942/275517/google-sony-4k-43-inch-kd-43x75k-1.jpg','TV','SS', 12, 'active');


CREATE TABLE PROMOTION(
    PROMOTION_ID VARCHAR(10) NOT NULL,
    PROMOTION_NAME VARCHAR(50) NOT NULL ,
    PROMOTION_CODE VARCHAR(50) NOT NULL,
    PROMOTION_STARTDATE DATE NOT NULL,
    PROMOTION_ENDDATE DATE NOT NULL,
    PROMOTION_PERCENT INT NOT NULL,
    PRIMARY KEY (PROMOTION_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE WAREHOUSE(
    STOCK_ID VARCHAR(10) NOT NULL,
    PRODUCT_ID VARCHAR(10) NOT NULL,
    PRODUCT_QUANTITY INT NOT NULL,
    PRODUCT_SALEPRICE INT NOT NULL,
    PRODUCT_IMPORTPRICE INT NOT NULL,
    PRODUCT_STATUS VARCHAR(50) NOT NULL,
    MFG DATE NOT NULL,
    PRIMARY KEY (STOCK_ID),
    FOREIGN KEY (PRODUCT_ID) REFERENCES PRODUCTS(PRODUCT_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE ORDERS(
    ORDER_ID VARCHAR(10) NOT NULL,
    ORDER_DATE DATE NOT NULL,
    ORDER_TOTAL INT NOT NULL,
    ORDER_STATUS VARCHAR(50) NOT NULL, 
    USER_ID VARCHAR(10) NOT NULL,
    PRIMARY KEY (ORDER_ID),
    FOREIGN KEY (USER_ID) REFERENCES USERS(USER_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE ORDER_DETAILS(
    ORDER_DETAIL_ID VARCHAR(10) NOT NULL,
    ORDER_DETAIL_QUANTITY INT NOT NULL,
    ORDER_DETAIL_PRICE INT NOT NULL,
    ORDERD_DETAIL_STATUS VARCHAR(50) NOT NULL,
    ORDER_ID VARCHAR(10) NOT NULL,
    PRODUCT_ID VARCHAR(10) NOT NULL,
    PRIMARY KEY (ORDER_DETAIL_ID),
    FOREIGN KEY (ORDER_ID) REFERENCES ORDERS(ORDER_ID),
    FOREIGN KEY (PRODUCT_ID) REFERENCES PRODUCTS(PRODUCT_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE REVENUE(
    REVENUE_ID VARCHAR(10) NOT NULL,
    REVENUE_DATE DATE NOT NULL,
    REVENUE_TOTAL INT NOT NULL,
    PRIMARY KEY (REVENUE_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE FEEDBACK(
    FEEDBACK_ID VARCHAR(10) NOT NULL,
    FEEDBACK_CONTENT VARCHAR(50) NOT NULL ,
    FEEDBACK_DATE DATE NOT NULL,
    FEEDBACK_STATUS VARCHAR(50) NOT NULL,
    USER_ID VARCHAR(10) NOT NULL,
    PRIMARY KEY (FEEDBACK_ID),
    FOREIGN KEY (USER_ID) REFERENCES USERS(USER_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE SITE_TRAFFIC(
    traffic_ID int AUTO_INCREMENT,
    traffic_DATE DATE NOT NULL,
    webTraffic INT NOT NULL,
    buyTraffic INT NOT NULL,
    traffic_TOTAL INT NOT NULL,
    PRIMARY KEY (traffic_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE WARRANTY(
    WARRANTY_ID VARCHAR(10) NOT NULL,
    CREATE_DATE DATE NOT NULL,
    END_DATE DATE NOT NULL,
    WARRANTY_STATUS VARCHAR(50) NOT NULL,
    ORDER_DETAIL_ID VARCHAR(10) NOT NULL,
    PRIMARY KEY (WARRANTY_ID),
    FOREIGN KEY (ORDER_DETAIL_ID) REFERENCES ORDER_DETAILS(ORDER_DETAIL_ID)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


------------- TRIGGER
-- Trigger to update NUMBER_PRODUCT in BRAND table
DELIMITER //

CREATE TRIGGER update_brand_product_count
AFTER INSERT ON PRODUCTS
FOR EACH ROW
BEGIN
    UPDATE BRAND
    SET NUMBER_PRODUCT = NUMBER_PRODUCT + 1
    WHERE BRAND_ID = NEW.BRAND_ID;
END;
//

-- Trigger to update NUMBER_PRODUCT in CATEGORY table
CREATE TRIGGER update_category_product_count
AFTER INSERT ON PRODUCTS
FOR EACH ROW
BEGIN
    UPDATE CATEGORY
    SET NUMBER_PRODUCT = NUMBER_PRODUCT + 1
    WHERE CATEGORY_ID = NEW.CATEGORY_ID;
END;
//

DELIMITER ;


