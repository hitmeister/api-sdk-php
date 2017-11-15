# Changelog

All Notable changes to `Hitmeister - API SDK for PHP` will be documented in this file.

## 1.17.2 - 2017-11-15

### Fixed

- Use correct separator to generate signatures under Windows

## 1.17.1 - 2017-10-27

### Fixed

- Possibility to used embedded transfers for `GET order-units/{id}` endpoint

## 1.17.0 - 2017-10-26

### Added

- Embedded field `product_feed_async_done` to the `ImportFileTransfer`

## 1.16.0 - 2017-10-26

### Added

- Embedded field `return_unit` to the `OrderUnitWithEmbeddedTransfer`

## 1.15.0 - 2017-10-12

### Removed

- endpoint `/claims`
- endpoint `/claims/{id_claim}/refund`

## 1.13.4 - 2017-08-03

### Added

- Field `real_main_category_id` to `CategoryTransfer`
- Field `real_mgb_article_number` to `ItemTransfer`

### Fixed

- Typo in carrier name `Bursped`

## 1.11.0 - 2017-04-03

### Added

- New field `cancel_reason`

## 1.7.0 - 2016-07-06

### Added
- New endpoints `product-data`
- New endpoint `product-data-status`
- New endpoint `shipping-groups`
- New endpoint `warehouses`
- Support of `PUT` methods

### Fixed
- Missing constants have been added

### Deprecated
- Field `location` in `POST /units/` endpoint will be overwritten by `warehouse.country`



## 1.6.1 - 2016-07-01

### Fixed
- Fix client version number

## 1.6.0 - 2016-07-01

### Added
- Change a major and a minor versions in order to match version of API itself

## 0.1.3 - 2016-04-05

### Added
- Property `is_seller_responsible` to `ClaimTransfer` and `ClaimWithEmbeddedTransfer`
- Property `interim_notice` to `ClaimMessageAddTransfer`

## 0.1.2 - 2016-03-15

### Added
- Property `shipping_group` and `warehouse` to all transfer objects used in `/units/` endpoint

## 0.1.1 - 2016-01-26

### Fixed
- Embedded fields may have `null` value
