# Changelog

All Notable changes to `Hitmeister - API SDK for PHP` will be documented in this file.

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
