# cataas-app
An example app which output a random cat image with filter, depending on current day of the week. Sunday - no filter, other days: monday - blur and so on: mono, sepia, negative, paint, pixel.

This application uses the library CataasApiPhp.

The refreshing of the image is limited with a quantity of 1 per minute, in order to prevent hangings of the cataas.com service.

But when the date is changing it is no need to wait, so image can be refreshed at 23:59:59 and then at 00:00:00.
