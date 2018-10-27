package com.supinfo.core;

import com.supinfo.TranscodeApplication;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.core.io.ClassPathResource;
import org.springframework.stereotype.Service;

import java.io.BufferedReader;
import java.io.File;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.URI;

@Service
@Qualifier(value="workerImpl")
public class WorkerImpl implements WorkerService {



    @Override
    public boolean convert(String fromPath, String toPath) throws IOException {

        URI uri = null;
        try {
            uri = new ClassPathResource("application.yaml").getURI();
        } catch (IOException e) {
            e.printStackTrace();
        }
        File fullPathToSubfolder = new File(uri).getAbsoluteFile();
        String projectFolder = fullPathToSubfolder.getAbsolutePath().split("target")[0];



        Runtime rt = Runtime.getRuntime();
        String command = "cmd /C " + projectFolder + "ffmpeg\\bin\\ffmpeg.exe -i " + "\""+projectFolder+ TranscodeApplication.ROOT+"\\" + fromPath+"\"" + " " + "\""+projectFolder+TranscodeApplication.ROOT+"\\" + toPath+"\"";
        Process pr = rt.exec(command);
        System.out.println(command);

        BufferedReader input = new BufferedReader(new InputStreamReader(pr.getErrorStream()));
        String line = null;

        try {
            while ((line = input.readLine()) != null)
                System.out.println(line);
            return true;
        } catch (IOException e) {
            e.printStackTrace();
            return false;
        }
    }

    @Override
    public int getDuration(String path) throws IOException {

        Runtime rt = Runtime.getRuntime();

        //Process pr = rt.exec("ffmpeg -version");




        return 0;
    }

}
