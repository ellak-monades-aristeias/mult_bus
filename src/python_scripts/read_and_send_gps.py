import gps
import time
import urllib2
import datetime

#Connect to local gpsd
session = gps.gps("localhost", "2947")
session.stream(gps.WATCH_ENABLE | gps.WATCH_NEWSTYLE)

basUrl  = 'http://bus-aggelos.rhcloud.com/insert.php'
busId   = '1'
busPass = '1234'
timeStep = 60

#Use this in order to send data exery timeStep seconds
time1 = datetime.datetime.now()
time2 = datetime.datetime.now()

while True:
  #Try to read the gps coordinates.
  try:
    report = session.next()
    #print report
    if report['class']=='TPV':
      if hasattr(report, 'time') and hasattr(report, 'lon') and hasattr(report, 'lat'):
        #print 'time: ' + report.time + ' lon: ' + str(report.lon) + ' lat: ' + str(report.lat)
        
        #If the desired time have passed, then send the coordinates to the server.
        time2 = datetime.datetime.now()
        timeDiff = time2 - time1
        if timeDiff.seconds > timeStep :
          urlstr = basUrl + '?id=' + busId + '&pass=' + busPass + '&when=' + report.time + '&lon=' + str(report.lon) + '&lat=' + str(report.lat)
          print urlstr
          try:
            urllib2.urlopen(urlstr).read();
          except:
            print 'unable to send: ' + urlstr
          time1 = time2
  except KeyError:
    pass
  except KeyboardInterrupt:
    quit()
  except StopIteration:
    session = None
    print "gpsd has terminated"