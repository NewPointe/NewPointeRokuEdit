/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package com.tschrock.roku.uploader;

import java.awt.Container;
import java.awt.Cursor;
import java.util.Calendar;
import java.util.GregorianCalendar;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JFrame;

/**
 *
 * @author tyler
 */
public class DatePick extends javax.swing.JPanel {

    /**
     * Creates new form DatePick
     */
    public DatePick() {
        initComponents();
        jTextField1.setEditable(false);
    }

    /**
     * This method is called from within the constructor to initialize the form.
     * WARNING: Do NOT modify this code. The content of this method is always
     * regenerated by the Form Editor.
     */
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jScrollPane1 = new javax.swing.JScrollPane();
        jTextPane1 = new javax.swing.JTextPane();
        jTextField1 = new javax.swing.JTextField();

        jScrollPane1.setViewportView(jTextPane1);

        jTextField1.setText("...");
        jTextField1.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                jTextField1MouseClicked(evt);
            }
        });
        jTextField1.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jTextField1ActionPerformed(evt);
            }
        });

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(this);
        this.setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addComponent(jTextField1, javax.swing.GroupLayout.DEFAULT_SIZE, 200, Short.MAX_VALUE)
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addComponent(jTextField1)
        );
    }// </editor-fold>//GEN-END:initComponents

    private void jTextField1MouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_jTextField1MouseClicked
        this.setCursor(Cursor.getPredefinedCursor(Cursor.WAIT_CURSOR));
        Container c = this.getParent();
        while(c.getParent()!=null){
            c = c.getParent();            
        }
        DateDialog dlg = new DateDialog((JFrame)c, true);
        gcal = dlg.showDialog(jTextField1.getLocationOnScreen());
        jTextField1.setText(strDates[gcal.get(Calendar.MONTH)] + " " + gcal.get(Calendar.DAY_OF_MONTH) + ", " + gcal.get(Calendar.YEAR));
        
        this.setCursor(Cursor.getDefaultCursor());
        
    }//GEN-LAST:event_jTextField1MouseClicked

    private void jTextField1ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jTextField1ActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_jTextField1ActionPerformed

    
    private GregorianCalendar gcal = null;
    
    public GregorianCalendar getDate() {
        return gcal;
    }
    
    private String[] strDates = {"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"};
    
    
    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JScrollPane jScrollPane1;
    private javax.swing.JTextField jTextField1;
    private javax.swing.JTextPane jTextPane1;
    // End of variables declaration//GEN-END:variables
}