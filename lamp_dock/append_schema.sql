-- 購入履歴テーブル
-- カラム　注文番号・userID・購入日時・商品の合計額

CREATE TABLE `purchase_history` (
    `order_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `purchase_date` datetime DEFAULT CURRENT_TIMESTAMP,
    `sum_price` int(11) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `purchase_history`
    MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT,
    ADD PRIMARY KEY (`order_id`),
    ADD KEY `user_id` (`user_id`);

-- 購入明細テーブル
-- カラム　購入明細ID・注文番号・itemID・購入時価格・購入数量

CREATE TABLE `purchase_details` (
    `detail_id` int(11) NOT NULL,
    `order_id` int(11) NOT NULL,
    `item_id` int(11) NOT NULL,
    `price` int(11) NOT NULL,
    `amount` int(11) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `purchase_details`
    MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT,
    ADD PRIMARY KEY (`detail_id`),
    ADD KEY `order_id` (`order_id`),
    ADD KEY `item_id` (`item_id`);