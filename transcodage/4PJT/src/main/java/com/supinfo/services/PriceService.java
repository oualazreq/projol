package com.supinfo.services;

public interface PriceService {

    Float convertToHour(String duration) ;

    String getDuration(String line);

    Float computePrice(String path);
}
