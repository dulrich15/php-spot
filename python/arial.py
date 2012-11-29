from __future__ import division

import os, sys
import win32com.client

Application = win32com.client.Dispatch("PowerPoint.Application")
Application.Visible = True

fn = os.path.join(os.path.abspath(os.path.dirname(__file__)), sys.argv[1])

Presentation = Application.Presentations.Open(r"%s" % fn)

for Slide in Presentation.Slides:
     for Shape in Slide.Shapes:
             Shape.TextFrame.TextRange.Font.Name = "Arial"
# Presentation.Save()
# Application.Quit()