# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

import scrapy

class CrawlingItem(scrapy.Item):
    # define the fields for your item here like:
    # name = scrapy.Field()
    coinName = scrapy.Field()
    coinPrice = scrapy.Field()
    date = scrapy.Field()
    pass
