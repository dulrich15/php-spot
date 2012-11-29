# -*- coding: mbcs -*-
# Created by makepy.py version 0.5.00
# By python version 2.7.3 (default, Apr 10 2012, 23:31:26) [MSC v.1500 32 bit (Intel)]
# From type library 'wmm2fxa.dll'
# On Thu Nov 29 09:21:10 2012
"""MovieMaker 2.0 MMFX Type Library"""
makepy_version = '0.5.00'
python_version = 0x20703f0

import win32com.client.CLSIDToClass, pythoncom, pywintypes
import win32com.client.util
from pywintypes import IID
from win32com.client import Dispatch

# The following 3 lines may need tweaking for the particular server
# Candidates are pythoncom.Missing, .Empty and .ArgNotFound
defaultNamedOptArg=pythoncom.Empty
defaultNamedNotOptArg=pythoncom.Empty
defaultUnnamedArg=pythoncom.Empty

CLSID = IID('{A2D4529E-84E0-4550-A2E0-C25D7C5CC0D0}')
MajorVersion = 1
MinorVersion = 0
LibraryFlags = 8
LCID = 0x0

from win32com.client import DispatchBaseClass
class IDXEffect(DispatchBaseClass):
	"""IDXEffect Interface"""
	CLSID = IID('{E31FB81B-1335-11D1-8189-0000F87557DB}')
	coclass_clsid = None

	_prop_map_get_ = {
		"Capabilities": (10000, 2, (3, 0), (), "Capabilities", None),
		"Duration": (10003, 2, (4, 0), (), "Duration", None),
		"Progress": (10001, 2, (4, 0), (), "Progress", None),
		"StepResolution": (10002, 2, (4, 0), (), "StepResolution", None),
	}
	_prop_map_put_ = {
		"Duration": ((10003, LCID, 4, 0),()),
		"Progress": ((10001, LCID, 4, 0),()),
	}

class IDXTMMAge(DispatchBaseClass):
	"""IDXTMMAge Interface"""
	CLSID = IID('{ADEADEFF-EE70-11D1-9066-00C04FD91ADE}')
	coclass_clsid = IID('{ADEADEB8-E54B-11D1-9A72-0000F875EADE}')

	_prop_map_get_ = {
		"Age": (1, 2, (3, 0), (), "Age", None),
		"BlurAmount": (8, 2, (3, 0), (), "BlurAmount", None),
		"Capabilities": (10000, 2, (3, 0), (), "Capabilities", None),
		"Duration": (10003, 2, (4, 0), (), "Duration", None),
		"EdgeFade": (9, 2, (3, 0), (), "EdgeFade", None),
		"FilmJerkiness": (7, 2, (3, 0), (), "FilmJerkiness", None),
		"FlickerFrequency": (6, 2, (3, 0), (), "FlickerFrequency", None),
		"FrameSkips": (10, 2, (3, 0), (), "FrameSkips", None),
		"Grey": (2, 2, (3, 0), (), "Grey", None),
		"LineFrequency": (4, 2, (3, 0), (), "LineFrequency", None),
		"LintFrequency": (5, 2, (3, 0), (), "LintFrequency", None),
		"NoiseFrequency": (3, 2, (3, 0), (), "NoiseFrequency", None),
		"PosterizeBits": (11, 2, (3, 0), (), "PosterizeBits", None),
		"Progress": (10001, 2, (4, 0), (), "Progress", None),
		"StepResolution": (10002, 2, (4, 0), (), "StepResolution", None),
	}
	_prop_map_put_ = {
		"Age": ((1, LCID, 4, 0),()),
		"BlurAmount": ((8, LCID, 4, 0),()),
		"Duration": ((10003, LCID, 4, 0),()),
		"EdgeFade": ((9, LCID, 4, 0),()),
		"FilmJerkiness": ((7, LCID, 4, 0),()),
		"FlickerFrequency": ((6, LCID, 4, 0),()),
		"FrameSkips": ((10, LCID, 4, 0),()),
		"Grey": ((2, LCID, 4, 0),()),
		"LineFrequency": ((4, LCID, 4, 0),()),
		"LintFrequency": ((5, LCID, 4, 0),()),
		"NoiseFrequency": ((3, LCID, 4, 0),()),
		"PosterizeBits": ((11, LCID, 4, 0),()),
		"Progress": ((10001, LCID, 4, 0),()),
	}

class IDXTMMFade(DispatchBaseClass):
	"""IDXTMMFade Interface"""
	CLSID = IID('{16B280FF-EE70-11D1-9066-00C04FD91ADE}')
	coclass_clsid = IID('{EC85D8F1-1C4E-46E4-A748-7AA04E7C0496}')

	_prop_map_get_ = {
		"Capabilities": (10000, 2, (3, 0), (), "Capabilities", None),
		"Center": (2, 2, (3, 0), (), "Center", None),
		"Duration": (10003, 2, (4, 0), (), "Duration", None),
		"FadeColor": (4, 2, (3, 0), (), "FadeColor", None),
		"FadeIn": (3, 2, (3, 0), (), "FadeIn", None),
		"Overlap": (1, 2, (4, 0), (), "Overlap", None),
		"Progress": (10001, 2, (4, 0), (), "Progress", None),
		"StepResolution": (10002, 2, (4, 0), (), "StepResolution", None),
	}
	_prop_map_put_ = {
		"Center": ((2, LCID, 4, 0),()),
		"Duration": ((10003, LCID, 4, 0),()),
		"FadeColor": ((4, LCID, 4, 0),()),
		"FadeIn": ((3, LCID, 4, 0),()),
		"Overlap": ((1, LCID, 4, 0),()),
		"Progress": ((10001, LCID, 4, 0),()),
	}

class IDXTMMVidAdjust(DispatchBaseClass):
	"""IDXTMMVidAdjust Interface"""
	CLSID = IID('{16B280FF-EE70-11D1-1111-00C04FD91ADE}')
	coclass_clsid = IID('{5A20FD6F-F8FE-4A22-9EE7-307D72D09E6E}')

	_prop_map_get_ = {
		"Brightness": (1, 2, (3, 0), (), "Brightness", None),
		"Capabilities": (10000, 2, (3, 0), (), "Capabilities", None),
		"Contrast": (2, 2, (4, 0), (), "Contrast", None),
		"Duration": (10003, 2, (4, 0), (), "Duration", None),
		"Gamma": (3, 2, (4, 0), (), "Gamma", None),
		"Progress": (10001, 2, (4, 0), (), "Progress", None),
		"StepResolution": (10002, 2, (4, 0), (), "StepResolution", None),
	}
	_prop_map_put_ = {
		"Brightness": ((1, LCID, 4, 0),()),
		"Contrast": ((2, LCID, 4, 0),()),
		"Duration": ((10003, LCID, 4, 0),()),
		"Gamma": ((3, LCID, 4, 0),()),
		"Progress": ((10001, LCID, 4, 0),()),
	}

class IWMSpecialEffectDXT(DispatchBaseClass):
	"""SpecialEffectDXT Interface"""
	CLSID = IID('{BF56DFFA-4125-4B43-84C2-AD09E0752E52}')
	coclass_clsid = IID('{C63344D8-70D3-4032-9B32-7A3CAD5091A5}')

	# The method Property is actually a property, but must be used as a method to correctly pass the arguments
	def Property(self, bstrPropertyName=defaultNamedNotOptArg):
		"""property Property"""
		return self._ApplyTypes_(1, 2, (12, 0), ((8, 1),), u'Property', None,bstrPropertyName
			)

	# The method SetProperty is actually a property, but must be used as a method to correctly pass the arguments
	def SetProperty(self, bstrPropertyName=defaultNamedNotOptArg, arg1=defaultUnnamedArg):
		"""property Property"""
		return self._oleobj_.InvokeTypes(1, LCID, 4, (24, 0), ((8, 1), (12, 1)),bstrPropertyName
			, arg1)

	_prop_map_get_ = {
		"Capabilities": (10000, 2, (3, 0), (), "Capabilities", None),
		"Duration": (10003, 2, (4, 0), (), "Duration", None),
		"Progress": (10001, 2, (4, 0), (), "Progress", None),
		"StepResolution": (10002, 2, (4, 0), (), "StepResolution", None),
	}
	_prop_map_put_ = {
		"Duration": ((10003, LCID, 4, 0),()),
		"Progress": ((10001, LCID, 4, 0),()),
	}

from win32com.client import CoClassBaseClass
# This CoClass is known by the name 'DXImageTransform.Microsoft.MovieMaker.Age.1'
class DXTMMAge(CoClassBaseClass): # A CoClass
	# DXTMMAge Class
	CLSID = IID('{ADEADEB8-E54B-11D1-9A72-0000F875EADE}')
	coclass_sources = [
	]
	coclass_interfaces = [
		IDXTMMAge,
	]
	default_interface = IDXTMMAge

# This CoClass is known by the name 'DXImageTransform.Microsoft.MovieMaker.Fade.1'
class DXTMMFade(CoClassBaseClass): # A CoClass
	# DXTMMFade Class
	CLSID = IID('{EC85D8F1-1C4E-46E4-A748-7AA04E7C0496}')
	coclass_sources = [
	]
	coclass_interfaces = [
		IDXTMMFade,
	]
	default_interface = IDXTMMFade

# This CoClass is known by the name 'DXImageTransform.Microsoft.MovieMaker.VidAdjust.1'
class DXTMMVidAdjust(CoClassBaseClass): # A CoClass
	# DXTMMVidAdjust Class
	CLSID = IID('{5A20FD6F-F8FE-4A22-9EE7-307D72D09E6E}')
	coclass_sources = [
	]
	coclass_interfaces = [
		IDXTMMVidAdjust,
	]
	default_interface = IDXTMMVidAdjust

# This CoClass is known by the name 'DXImageTransform.Microsoft.MMSpecialEffect1Input.1'
class WMSpecialEffectDXT1Input(CoClassBaseClass): # A CoClass
	# WMSpecialEffectDXT1Input Class
	CLSID = IID('{B4DC8DD9-2CC1-4081-9B2B-20D7030234EF}')
	coclass_sources = [
	]
	coclass_interfaces = [
		IWMSpecialEffectDXT,
	]
	default_interface = IWMSpecialEffectDXT

# This CoClass is known by the name 'DXImageTransform.Microsoft.MMSpecialEffect2Inputs.1'
class WMSpecialEffectDXT2Inputs(CoClassBaseClass): # A CoClass
	# WMSpecialEffectDXT2Inputs Class
	CLSID = IID('{C63344D8-70D3-4032-9B32-7A3CAD5091A5}')
	coclass_sources = [
	]
	coclass_interfaces = [
		IWMSpecialEffectDXT,
	]
	default_interface = IWMSpecialEffectDXT

# This CoClass is known by the name 'DXImageTransform.Microsoft.MMSpecialEffectInplace1Input.1'
class WMSpecialEffectDXTInplace1Input(CoClassBaseClass): # A CoClass
	# WMSpecialEffectDXTInplace1Input Class
	CLSID = IID('{353359C1-39E1-491B-9951-464FD8AB071C}')
	coclass_sources = [
	]
	coclass_interfaces = [
		IWMSpecialEffectDXT,
	]
	default_interface = IWMSpecialEffectDXT

class WMSpecialEffectDXTInplace1InputPropPage(CoClassBaseClass): # A CoClass
	# WMSpecialEffectDXTInplace1Input Class
	CLSID = IID('{474993E1-5076-450F-A052-D52F8F3AE8A4}')
	coclass_sources = [
	]
	coclass_interfaces = [
	]

IDXEffect_vtables_dispatch_ = 1
IDXEffect_vtables_ = [
	(( u'Capabilities' , u'pVal' , ), 10000, (10000, (), [ (16387, 10, None, None) , ], 1 , 2 , 4 , 0 , 28 , (3, 0, None, None) , 0 , )),
	(( u'Progress' , u'pVal' , ), 10001, (10001, (), [ (16388, 10, None, None) , ], 1 , 2 , 4 , 0 , 32 , (3, 0, None, None) , 0 , )),
	(( u'Progress' , u'pVal' , ), 10001, (10001, (), [ (4, 1, None, None) , ], 1 , 4 , 4 , 0 , 36 , (3, 0, None, None) , 0 , )),
	(( u'StepResolution' , u'pVal' , ), 10002, (10002, (), [ (16388, 10, None, None) , ], 1 , 2 , 4 , 0 , 40 , (3, 0, None, None) , 0 , )),
	(( u'Duration' , u'pVal' , ), 10003, (10003, (), [ (16388, 10, None, None) , ], 1 , 2 , 4 , 0 , 44 , (3, 0, None, None) , 0 , )),
	(( u'Duration' , u'pVal' , ), 10003, (10003, (), [ (4, 1, None, None) , ], 1 , 4 , 4 , 0 , 48 , (3, 0, None, None) , 0 , )),
]

IDXTMMAge_vtables_dispatch_ = 1
IDXTMMAge_vtables_ = [
	(( u'Age' , u'pVal' , ), 1, (1, (), [ (16387, 10, None, None) , ], 1 , 2 , 4 , 0 , 52 , (3, 0, None, None) , 0 , )),
	(( u'Age' , u'pVal' , ), 1, (1, (), [ (3, 1, None, None) , ], 1 , 4 , 4 , 0 , 56 , (3, 0, None, None) , 0 , )),
	(( u'Grey' , u'pVal' , ), 2, (2, (), [ (16387, 10, None, None) , ], 1 , 2 , 4 , 0 , 60 , (3, 0, None, None) , 0 , )),
	(( u'Grey' , u'pVal' , ), 2, (2, (), [ (3, 1, None, None) , ], 1 , 4 , 4 , 0 , 64 , (3, 0, None, None) , 0 , )),
	(( u'NoiseFrequency' , u'pVal' , ), 3, (3, (), [ (16387, 10, None, None) , ], 1 , 2 , 4 , 0 , 68 , (3, 0, None, None) , 0 , )),
	(( u'NoiseFrequency' , u'pVal' , ), 3, (3, (), [ (3, 1, None, None) , ], 1 , 4 , 4 , 0 , 72 , (3, 0, None, None) , 0 , )),
	(( u'LineFrequency' , u'pVal' , ), 4, (4, (), [ (16387, 10, None, None) , ], 1 , 2 , 4 , 0 , 76 , (3, 0, None, None) , 0 , )),
	(( u'LineFrequency' , u'pVal' , ), 4, (4, (), [ (3, 1, None, None) , ], 1 , 4 , 4 , 0 , 80 , (3, 0, None, None) , 0 , )),
	(( u'LintFrequency' , u'pVal' , ), 5, (5, (), [ (16387, 10, None, None) , ], 1 , 2 , 4 , 0 , 84 , (3, 0, None, None) , 0 , )),
	(( u'LintFrequency' , u'pVal' , ), 5, (5, (), [ (3, 1, None, None) , ], 1 , 4 , 4 , 0 , 88 , (3, 0, None, None) , 0 , )),
	(( u'FlickerFrequency' , u'pVal' , ), 6, (6, (), [ (16387, 10, None, None) , ], 1 , 2 , 4 , 0 , 92 , (3, 0, None, None) , 0 , )),
	(( u'FlickerFrequency' , u'pVal' , ), 6, (6, (), [ (3, 1, None, None) , ], 1 , 4 , 4 , 0 , 96 , (3, 0, None, None) , 0 , )),
	(( u'FilmJerkiness' , u'pVal' , ), 7, (7, (), [ (16387, 10, None, None) , ], 1 , 2 , 4 , 0 , 100 , (3, 0, None, None) , 0 , )),
	(( u'FilmJerkiness' , u'pVal' , ), 7, (7, (), [ (3, 1, None, None) , ], 1 , 4 , 4 , 0 , 104 , (3, 0, None, None) , 0 , )),
	(( u'BlurAmount' , u'pVal' , ), 8, (8, (), [ (16387, 10, None, None) , ], 1 , 2 , 4 , 0 , 108 , (3, 0, None, None) , 0 , )),
	(( u'BlurAmount' , u'pVal' , ), 8, (8, (), [ (3, 1, None, None) , ], 1 , 4 , 4 , 0 , 112 , (3, 0, None, None) , 0 , )),
	(( u'EdgeFade' , u'pVal' , ), 9, (9, (), [ (16387, 10, None, None) , ], 1 , 2 , 4 , 0 , 116 , (3, 0, None, None) , 0 , )),
	(( u'EdgeFade' , u'pVal' , ), 9, (9, (), [ (3, 1, None, None) , ], 1 , 4 , 4 , 0 , 120 , (3, 0, None, None) , 0 , )),
	(( u'FrameSkips' , u'pVal' , ), 10, (10, (), [ (16387, 10, None, None) , ], 1 , 2 , 4 , 0 , 124 , (3, 0, None, None) , 0 , )),
	(( u'FrameSkips' , u'pVal' , ), 10, (10, (), [ (3, 1, None, None) , ], 1 , 4 , 4 , 0 , 128 , (3, 0, None, None) , 0 , )),
	(( u'PosterizeBits' , u'pVal' , ), 11, (11, (), [ (16387, 10, None, None) , ], 1 , 2 , 4 , 0 , 132 , (3, 0, None, None) , 0 , )),
	(( u'PosterizeBits' , u'pVal' , ), 11, (11, (), [ (3, 1, None, None) , ], 1 , 4 , 4 , 0 , 136 , (3, 0, None, None) , 0 , )),
]

IDXTMMFade_vtables_dispatch_ = 1
IDXTMMFade_vtables_ = [
	(( u'Overlap' , u'pVal' , ), 1, (1, (), [ (16388, 10, None, None) , ], 1 , 2 , 4 , 0 , 52 , (3, 0, None, None) , 0 , )),
	(( u'Overlap' , u'pVal' , ), 1, (1, (), [ (4, 1, None, None) , ], 1 , 4 , 4 , 0 , 56 , (3, 0, None, None) , 0 , )),
	(( u'Center' , u'pVal' , ), 2, (2, (), [ (16387, 10, None, None) , ], 1 , 2 , 4 , 0 , 60 , (3, 0, None, None) , 0 , )),
	(( u'Center' , u'pVal' , ), 2, (2, (), [ (3, 1, None, None) , ], 1 , 4 , 4 , 0 , 64 , (3, 0, None, None) , 0 , )),
	(( u'FadeIn' , u'pVal' , ), 3, (3, (), [ (16387, 10, None, None) , ], 1 , 2 , 4 , 0 , 68 , (3, 0, None, None) , 0 , )),
	(( u'FadeIn' , u'pVal' , ), 3, (3, (), [ (3, 1, None, None) , ], 1 , 4 , 4 , 0 , 72 , (3, 0, None, None) , 0 , )),
	(( u'FadeColor' , u'pVal' , ), 4, (4, (), [ (16387, 10, None, None) , ], 1 , 2 , 4 , 0 , 76 , (3, 0, None, None) , 0 , )),
	(( u'FadeColor' , u'pVal' , ), 4, (4, (), [ (3, 1, None, None) , ], 1 , 4 , 4 , 0 , 80 , (3, 0, None, None) , 0 , )),
]

IDXTMMVidAdjust_vtables_dispatch_ = 1
IDXTMMVidAdjust_vtables_ = [
	(( u'Brightness' , u'pVal' , ), 1, (1, (), [ (16387, 10, None, None) , ], 1 , 2 , 4 , 0 , 52 , (3, 0, None, None) , 0 , )),
	(( u'Brightness' , u'pVal' , ), 1, (1, (), [ (3, 1, None, None) , ], 1 , 4 , 4 , 0 , 56 , (3, 0, None, None) , 0 , )),
	(( u'Contrast' , u'pVal' , ), 2, (2, (), [ (16388, 10, None, None) , ], 1 , 2 , 4 , 0 , 60 , (3, 0, None, None) , 0 , )),
	(( u'Contrast' , u'pVal' , ), 2, (2, (), [ (4, 1, None, None) , ], 1 , 4 , 4 , 0 , 64 , (3, 0, None, None) , 0 , )),
	(( u'Gamma' , u'pVal' , ), 3, (3, (), [ (16388, 10, None, None) , ], 1 , 2 , 4 , 0 , 68 , (3, 0, None, None) , 0 , )),
	(( u'Gamma' , u'pVal' , ), 3, (3, (), [ (4, 1, None, None) , ], 1 , 4 , 4 , 0 , 72 , (3, 0, None, None) , 0 , )),
]

IWMSpecialEffectDXT_vtables_dispatch_ = 1
IWMSpecialEffectDXT_vtables_ = [
	(( u'Property' , u'bstrPropertyName' , u'pvarValue' , ), 1, (1, (), [ (8, 1, None, None) , 
			(16396, 10, None, None) , ], 1 , 2 , 4 , 0 , 52 , (3, 0, None, None) , 0 , )),
	(( u'Property' , u'bstrPropertyName' , u'pvarValue' , ), 1, (1, (), [ (8, 1, None, None) , 
			(12, 1, None, None) , ], 1 , 4 , 4 , 0 , 56 , (3, 0, None, None) , 0 , )),
]

RecordMap = {
}

CLSIDToClassMap = {
	'{BF56DFFA-4125-4B43-84C2-AD09E0752E52}' : IWMSpecialEffectDXT,
	'{474993E1-5076-450F-A052-D52F8F3AE8A4}' : WMSpecialEffectDXTInplace1InputPropPage,
	'{C63344D8-70D3-4032-9B32-7A3CAD5091A5}' : WMSpecialEffectDXT2Inputs,
	'{E31FB81B-1335-11D1-8189-0000F87557DB}' : IDXEffect,
	'{16B280FF-EE70-11D1-9066-00C04FD91ADE}' : IDXTMMFade,
	'{16B280FF-EE70-11D1-1111-00C04FD91ADE}' : IDXTMMVidAdjust,
	'{353359C1-39E1-491B-9951-464FD8AB071C}' : WMSpecialEffectDXTInplace1Input,
	'{EC85D8F1-1C4E-46E4-A748-7AA04E7C0496}' : DXTMMFade,
	'{ADEADEFF-EE70-11D1-9066-00C04FD91ADE}' : IDXTMMAge,
	'{B4DC8DD9-2CC1-4081-9B2B-20D7030234EF}' : WMSpecialEffectDXT1Input,
	'{5A20FD6F-F8FE-4A22-9EE7-307D72D09E6E}' : DXTMMVidAdjust,
	'{ADEADEB8-E54B-11D1-9A72-0000F875EADE}' : DXTMMAge,
}
CLSIDToPackageMap = {}
win32com.client.CLSIDToClass.RegisterCLSIDsFromDict( CLSIDToClassMap )
VTablesToPackageMap = {}
VTablesToClassMap = {
	'{E31FB81B-1335-11D1-8189-0000F87557DB}' : 'IDXEffect',
	'{BF56DFFA-4125-4B43-84C2-AD09E0752E52}' : 'IWMSpecialEffectDXT',
	'{ADEADEFF-EE70-11D1-9066-00C04FD91ADE}' : 'IDXTMMAge',
	'{16B280FF-EE70-11D1-9066-00C04FD91ADE}' : 'IDXTMMFade',
	'{16B280FF-EE70-11D1-1111-00C04FD91ADE}' : 'IDXTMMVidAdjust',
}


NamesToIIDMap = {
	'IDXTMMVidAdjust' : '{16B280FF-EE70-11D1-1111-00C04FD91ADE}',
	'IDXTMMAge' : '{ADEADEFF-EE70-11D1-9066-00C04FD91ADE}',
	'IWMSpecialEffectDXT' : '{BF56DFFA-4125-4B43-84C2-AD09E0752E52}',
	'IDXTMMFade' : '{16B280FF-EE70-11D1-9066-00C04FD91ADE}',
	'IDXEffect' : '{E31FB81B-1335-11D1-8189-0000F87557DB}',
}


