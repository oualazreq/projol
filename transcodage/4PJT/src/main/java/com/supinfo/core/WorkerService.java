package com.supinfo.core;

import java.io.IOException;

public interface WorkerService {

    boolean convert(String fromPath, String toPath) throws IOException;

    int getDuration(String path) throws IOException;
}
