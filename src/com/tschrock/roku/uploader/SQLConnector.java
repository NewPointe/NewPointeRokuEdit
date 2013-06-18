/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package com.tschrock.roku.uploader;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author tyler
 */
public class SQLConnector {

    private String hostAddress = "localhost";
    private String database = "";
    private String usernm = "";
    private String passwrd = "";
    private String driver = "com.mysql.jdbc.Driver";
    private Boolean connected = false;
    private static Connection con = null;

    public SQLConnector(String database) {
        this.database = database;
    }

    public SQLConnector(String database, String hostAddress) {
        this.database = database;
        this.hostAddress = hostAddress;
    }

    public SQLConnector(String database, String hostAddress, String usernm, String passwrd) {
        this.database = database;
        this.hostAddress = hostAddress;
        this.usernm = usernm;
        this.passwrd = passwrd;
    }

    public SQLConnector(String database, String hostAddress, String usernm, String passwrd, String driver) {
        this.database = database;
        this.hostAddress = hostAddress;
        this.usernm = usernm;
        this.passwrd = passwrd;
        this.driver = driver;
    }

    public boolean connect() {
        try {
            return connect_throwerrors();
        } catch (SQLException | ClassNotFoundException | InstantiationException | IllegalAccessException ex) {
            Logger.getLogger(Main.class.getName()).log(Level.SEVERE, null, ex);
            return false;
        }
    }

    public boolean connect_throwerrors() throws SQLException, ClassNotFoundException, InstantiationException, IllegalAccessException {
        if (con == null || this.connected == false) {
            try {
                Class.forName(driver).newInstance();
                if (!this.usernm.equals("")) {
                    con = DriverManager.getConnection("jdbc:mysql://" + this.hostAddress + "/" + this.database, this.usernm, this.passwrd);
                } else {
                    con = DriverManager.getConnection(this.hostAddress);
                }
                connected = true;
                return true;
            } catch (SQLException | ClassNotFoundException | InstantiationException | IllegalAccessException ex) {
                con = null;
                connected = false;
                throw ex;
            }
        } else {
            connected = true;
            return true;
        }
    }

    public ResultSet runQuery(String theQuery) throws SQLException {
        if (this.connect()) {
            Statement stmt = con.createStatement();
            return stmt.executeQuery(theQuery);
        } else {
            throw new SQLException("Could not connect to Database!");
        }
    }
    public int runUpdateQuery(String theQuery) throws SQLException {
        if (this.connect()) {
            Statement stmt = con.createStatement();
            return stmt.executeUpdate(theQuery);
        } else {
            throw new SQLException("Could not connect to Database!");
        }
    }
}
