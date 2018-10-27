package com.supinfo.services;

import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.stereotype.Service;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

@Service
@Qualifier(value="priceServiceImpl")
public class PriceServiceImpl implements PriceService {
    @Override
    public Float convertToHour(String duration) {
        String[] timeDetails = duration.split(":");

        Float hour = new Float(timeDetails[0]);
        Float minute = new Float(timeDetails[1]);
        Float seconds = new Float(timeDetails[2]);

        return hour + minute/60 + seconds/3600;
    }

    @Override
    public String getDuration(String line) {
        String[] durationData = line.trim().split(",");

        String duration = durationData[0].split("\\s")[1];

        return duration;
    }

    @Override
    public Float computePrice(String path) {
        String command = "cmd /C D:\\4PJT\\transcode\\ffmpeg\\bin\\ffmpeg.exe -i "+"\"" +path+"\"" +" 2>&1| findstr "+ "\"Duration\"" ;

        Runtime runtime = Runtime.getRuntime();
        Process process = null;
        try {

            process = runtime.exec(command);

        } catch (IOException e) {
            e.printStackTrace();
        }
        BufferedReader input = new BufferedReader(new InputStreamReader((process.getInputStream())));
        String line = null;

        Float hour = null;
        /*Float price = null;*/
        System.out.println(command);
        try {
            while((line = input.readLine()) != null) {

                System.out.println(line);

                hour = convertToHour( getDuration(line));
                System.out.println(hour);
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
        // pour regler le seuil à partir duquel le client paie
        /*int retVal = Float.compare(hour,0.5f);
        if(retVal <=0){
            price = 0f;
        }
        else{
            price =  hour;
        }*/
        return hour;
    }
}
